<x-metronics-layout>
    <x-organism.card :title="__('Neraca Saldo')">
        <table class="table table-striped border-1 gs-7">
            <thead class="border-1">
                <tr class="odd">
                    <th>Kode</th>
                    <th>Nama Akun</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                </tr>
            </thead>
            <tbody>
                @forelse($akun as $item)
                <tr class="odd">
                    <td>{{$item->kode}}</td>
                    <td>{{$item->deskripsi}}</td>
                    <td>{{$item->debet}}</td>
                    <td>{{$item->kredit}}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </x-organism.card>
</x-metronics-layout>
