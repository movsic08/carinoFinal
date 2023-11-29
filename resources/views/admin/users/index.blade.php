<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Verified</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allUsers as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->email_verified_at)
                        <span style="color: green;">Verified</span>
                    @else
                        <span style="color: red;">Not Verified</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


