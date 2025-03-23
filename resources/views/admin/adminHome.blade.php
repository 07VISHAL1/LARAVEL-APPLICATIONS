
<x-app-layout>
  <style>
      h1{
      margin-left:16rem;    
      }
      .card{
        width: 16rem;
        margin-top: 8rem;
        margin-left: 17rem;
      }
      #abc{
        margin-left: 1rem;
      }
      
  </style>
  <h1>
      Hello {{ Auth::user()->name }} !!
  </h1>

  <!-- <div class="d-flex justify-content-around flex-wrap" style="
    margin-top: 4rem;
    margin-left: 14rem;">
    <div class="card" style="width: 18rem; margin: 1rem;">
        <img src="image/OIP.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">User Management</h5>
            <a href="/register-user" class="btn btn-primary">Register User</a>
        </div>
    </div> -->
    
    <!-- <div class="card" id="abc" style="width: 18rem; margin: 1rem;">
        <img src="image/OIP 3.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Salary Management</h5>
            <a href="/add-user-salary" class="btn btn-primary" style="margin-top: 2.5rem;">Add Employee Salary</a>
        </div>
    </div> -->

    <!-- <div class="card" id="abc" style="width: 18rem; margin: 1rem;">
        <img src="image/OIP 4.jpeg" class="card-img-top" alt="..." style="
    height: 15rem;">
        <div class="card-body">
            <h5 class="card-title">Employee List</h5>
            <a href="/user-info-data" class="btn btn-primary">Employee List</a>
        </div>
    </div>
</div> -->

</x-app-layout>
