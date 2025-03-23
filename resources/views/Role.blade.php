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
                    <th>Serial Number</th>
                    <th data-sortable="true">Roles</th>
                    <th data-sortable="false">Created At</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
</div>

<script type="text/javascript" src="~/Scripts/jquery.js"></script>
<script type="text/javascript" src="~/Scripts/data-table/jquery.dataTables.js"></script>

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
          
            ajax: "{{ url('roles-data') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                
                { data: 'created_at' }
            ]
        });
        
t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
     t.cell(cell).invalidate('dom');
        } );
    } ).draw();
    
    });
</script>
</x-app-layout>