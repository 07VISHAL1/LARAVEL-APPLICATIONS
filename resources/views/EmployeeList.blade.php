<x-app-layout>
<style>
  .centered-table {
    margin-top: 2rem;
    margin-left: 16rem;
    width: 80%;
}
body {
    display: flex;
    justify-content: flex-start; /* Align to the left */
    align-items: center;
    min-height: 100vh;
    background-color: #f4f4f4;
    margin: 0;
}

.container {
    display: flex;
    justify-content: flex-start; /* Align content towards the left */
    align-items: center;
    width: 100%;
    min-height: 95vh;
    padding-left: 20px; /* Adjust spacing from sidebar */
}

table {
    width: 150vh;  /* Large but slightly reduced to fit sidebar */
    /* height: 75vh; */
    border-collapse: collapse;
    background: white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    border-radius: 12px;
    overflow: hidden;
    margin-left: 10px; /* Bring closer to the sidebar */
}

th, td {
    padding: 22px;
    text-align: left;
    font-size: 20px;
    border-bottom: 2px solid #ddd;
}

th {
    background: #007bff;
    color: white;
    text-align: center;
    font-size: 22px;
}

tr:nth-child(even) {
    background: #f2f2f2;
}

tr:hover {
    background: #e0e0e0;
}

td img {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
    margin: auto;
}

.center {
    text-align: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding-left: 5px; /* Reduce left padding for mobile */
    }

    table {
        width: 95%;
        height: auto;
        margin-left: 0;
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    th, td {
        padding: 15px;
        font-size: 18px;
    }

    td img {
        width: 50px;
        height: 50px;
    }
}



</style>
<div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold">User List</h2>
    <a href="{{ url('register-user') }}" class="bg-green-500 text-white px-4 py-2 rounded">
        + Add User
    </a>
</div>
        <div class="centered-table">
        <table>
    <thead>
        <tr align="left">
            <th>Serial Number</th>
            <th data-sortable="true">Name</th>
            <th data-sortable="false">Email</th>
            <th data-sortable="false">Image</th>
            <th data-sortable="false">Created At</th>
            <th data-sortable="false">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user_data as $index => $user)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ isset($user->name) ? $user->name : 'N/A' }}</td>
        <td>{{ isset($user->email) ? $user->email : 'N/A' }}</td>
        <td>
            @if(isset($user->image_path) && !empty($user->image_path))
                <img src="{{ asset($user->image_path) }}" alt="User Image" width="50">
            @else
                <img src="{{url('image/logo.jpg')}}" alt="{{url('image/logo.jpg')}}" width="50">
            @endif
        </td>
        <td>{{ isset($user->created_at) ? $user->created_at->format('d-M-Y'): 'N/A' }}
            <br>
            {{ isset($user->created_at) ? $user->created_at->format('h:i A'): 'N/A' }}
        </td>
        <td class="px-4 py-2">
            <div class="flex space-x-2">
                <a href="{{ route('edit-user', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 1.5l7.5 7.5-8.5 8.5H2.5V10z"></path> 
                    </svg>
                    Edit
                </a>
                <form method="POST" action="{{ route('delete-user', $user->id) }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 6h8M9 6v8m2-8v8m-4 8h8a2 2 0 002-2V6H4v10a2 2 0 002 2z"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </td>
    </tr>

        @endforeach
    </tbody>
</table>

</div>



<!-- <script>
    $(document).ready(function(){
    var t=  $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]],
          
            ajax: "{{ url('user-data') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'created_at' }
            ]
        });
        
t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
     t.cell(cell).invalidate('dom');
        } );
    } ).draw();
    
    }); -->
<!-- </script> -->
</x-app-layout>