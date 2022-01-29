<?php

namespace App\Http\Services\Repositories;

use App\Models\Keuangan\JurnalPenjualan;
use App\Models\Penjualan\Penjualan;
use Illuminate\Support\Facades\Auth;

class JurnalSetPiutangRepo
{
    public function kode()
    {
        // query
        $query = JurnalPenjualan::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '1/PIPJ/'.date('Y');
        }

        $num = $query->first()->last_num + 1;
        return $num."/PIPJ/".date('Y');
    }

    public function store($data)
    {
        $jurnalSetPiutang = JurnalPenjualan::query()->create([
            'kode'=>$this->kode(),
            'active_cash'=>session('ClosedCash'),
            'tgl_jurnal'=>$data->tgl_jurnal,
            'customer_id'=>$data->customer_id,
            'total_bayar'=>$data->total_bayar,
            'user_id'=>Auth::id(),
            'keterangan'=>$data->keterangan,
        ]);

        $this->storeDetail($data, $jurnalSetPiutang);
    }

    public function update($data)
    {
        $jurnalPenjualan = JurnalPenjualan::query()->find($data->jurnal_penjualan_id);

        // rollback detail
        foreach ($jurnalPenjualan->jurnalPenjualanDetail as $item){
            // set belum
            Penjualan::query()->find($item['penjualan_id'])->update([
                'status_bayar'=>'belum'
            ]);
        }

        // delete jurnal_transaksi
        $jurnalPenjualan->jurnalTransaksi()->delete();

        // delete jurnal_penjualan_detail
        $jurnalPenjualan->jurnalPenjualanDetail()->delete();

        // update field
        $jurnalPenjualan->update([
            'tgl_jurnal'=>$data->tgl_jurnal,
            'customer_id'=>$data->customer_id,
            'total_bayar'=>$data->total_bayar,
            'user_id'=>Auth::id(),
            'keterangan'=>$data->keterangan,
        ]);

        $this->storeDetail($data, $jurnalPenjualan);
    }

    public function destroy($id): void
    {
        $jurnalPenjualan = JurnalPenjualan::query()->find($id);

        // rollback penjualan set back to 'belum' on status_bayar column
        foreach ($jurnalPenjualan->jurnalPenjualanDetail as $item){
            // set belum
            Penjualan::query()->find($item['penjualan_id'])->update([
                'status_bayar'=>'belum'
            ]);
        }

        // delete jurnal_transaksi
        $jurnalPenjualan->jurnalTransaksi()->delete();

        // delete jurnal_penjualan_detail
        $jurnalPenjualan->jurnalPenjualanDetail()->delete();

        // delete jurnal_penjualan
        $jurnalPenjualan->delete();
    }

    /**
     * @param $data
     * @param $jurnalPenjualan
     */
    protected function storeDetail($data, $jurnalPenjualan): void
    {
        foreach ($data->detail as $item) {
            $jurnalPenjualan->jurnalPenjualanDetail()->create([
                'penjualan_id' => $item['penjualan_id'],
            ]);
            // set lunas
            Penjualan::query()->find($item['penjualan_id'])->update([
                'status_bayar' => 'piutang'
            ]);
        }

        // debet
        $jurnalPenjualan->jurnalTransaksi()->create([
            'akun_id' => $data->akunDebet,
            'nominal_debet' => $data->total_bayar,
            'nominal_kredit' => null,
        ]);

        // kredit
        $jurnalPenjualan->jurnalTransaksi()->create([
            'akun_id' => $data->akunKredit,
            'nominal_debet' => null,
            'nominal_kredit' => $data->total_bayar,
        ]);
    }
}
