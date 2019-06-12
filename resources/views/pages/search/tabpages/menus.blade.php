<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->price * 0.01 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
