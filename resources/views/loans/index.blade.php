<x-app-layout>
    <div class="container">
        <h1>Loans</h1>
        <a href="{{ route('loans.create') }}" class="btn btn-primary">Add Loan</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    @if (Auth::user()->hasRole('Admin'))
                        <th>User</th> <!-- Only display this column if the user is Admin -->
                    @endif
                    <th>Loan Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{ $loan->id }}</td>
                        <td>{{ $loan->item->name }}</td>
                        @if (Auth::user()->hasRole('Admin'))
                            <td>{{ $loan->user->name }}</td> <!-- Only display this cell if the user is Admin -->
                        @endif
                        <td>{{ $loan->created_at }}</td>
                        <td>{{ $loan->return_date ?? 'Not returned yet' }}</td>
                        <td>{{ $loan->status }}</td>
                        <td>
                            <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            @can('Return Items')
                                @if($loan->status == 'borrowed')
                                    <form action="{{ route('loans.returnItem', $loan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Return</button>
                                    </form>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
