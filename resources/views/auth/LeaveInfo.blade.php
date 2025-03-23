<x-app-layout>
<style>
  .centered-table {
    margin-top: 2rem;
    margin-left: 16rem;
    width: 80%;
}
</style>

        <div class="centered-table">
        <table id="datatable" class="display">
            <thead>
                <tr align="left">
                    <th>Email</th>
                    <th data-sortable="true">starting </th>
                    <th data-sortable="false">Ending</th>
                    <th data-sortable="false">Reason </th>
                    <th data-sortable="false">status</th>
                    <th data-sortable="false">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
</div>



<script>
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
          
            ajax: "{{ url('getLeaveInfo') }}",
            columns: [
                { data: 'email' },
                { data: 'starting_date' },
                { data: 'ending_date' },
                { data: 'reason_for_leave' },
                {
    data: 'status',
    render: function(data, type, row) {
        if (data === 'pending') {
            return '<div class="btn-group">' +
                '<button type="button" class="btn btn-danger" aria-haspopup="true" aria-expanded="false">' +
                'Pending' +
                '</button>' +
                '</div>';
        } else if (data === 'Accepted') {
            return '<div class="btn-group">' +
                '<button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false">' +
                'Accepted' +
                '</button>' +
                '</div>';
        } else if (data === 'Rejected') {
            return '<div class="btn-group">' +
                '<button type="button" class="btn btn-danger" aria-haspopup="true" aria-expanded="false">' +
                'Rejected' +
                '</button>' +
                '</div>';
        } else {
            return '<span class="btn btn-primary">' + data + '</span>';
        }
    }
},

            {"mRender": function ( data, type, row ) {
                        return '<a href=/leave-update?id='+row.id+'><i class="fa-regular fa-pen-to-square"></i></a>';}
                }
            ]
        });
        

    });
</script>
</x-app-layout>