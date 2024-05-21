<div>
    <table class="table">
        <thead>
        <tr>
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($rows as $row)
            @forelse($row as $cell)
                <tr>
                    <td>{{ $cell }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">Chưa có dữ liệu.</td>
                </tr>
            @endforelse
        @endforeach
        </tbody>
    </table>
</div>
