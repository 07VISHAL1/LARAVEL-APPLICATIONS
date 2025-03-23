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
                    
                    <th data-sortable="true">User Id</th>
                    <th data-sortable="false">Phone No</th>
                    <th data-sortable="false">DOB</th>
                    <th data-sortable="false">DOJ</th>
                    <th data-sortable="false">Tax Regime</th>
                    <th data-sortable="false">Emergency no</th>
                    <th data-sortable="false">Employee code</th>



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
            ajax: "{{ url('user-info-table') }}",
            columns: [
                { data: 'user_id' },
                { data: 'phone_no' },
                { data: 'date_of_birth' },
                { data: 'date_of_joining' },
                { data: 'tax_regime' },
                { data: 'emrgency_phone_no' },
                { data: 'employee_code' },


            ]
        });
        
    });
</script>
</x-app-layout>
