@extends('layouts.abc')
@include('components.sidemenu2')
@include('layouts.navUser')

<style>
    h1 {
        margin-left: 6rem;
    }

    h2 {
        margin-top: 2rem;
    }

    /* Styles for the datepicker */
    .datepicker {
        font-family: Arial, sans-serif;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .datepicker input {
        margin-right: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .py-12 {
        margin-left: 15rem;
    }
</style>

<div class="py-12 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-xl">
        <section>
            @if (session('success'))
            <div id="alert" class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if (session('errors'))
            <div id="alert" class="alert alert-danger">
                {{ session('errors') }}
            </div>
            @endif
            @if (session('Error'))
            <div id="alert" class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form id="leaveForm" method="POST" action="/leave-marked">
                @csrf

                <div class="form-group">
                    <label for="leave_type">Leave Type</label>
                    <select id="leave_type" class="form-control" name="type" required>
                        <option value="">Select Leave Type</option>
                        <option value="Annual Leave">Annual Leave</option>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Maternity Leave">Maternity Leave</option>
                        <option value="Paternity Leave">Paternity Leave</option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    <!-- Add more leave types as needed -->
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input id="start_date" type="date" class="form-control" name="starting_date" required>
                    <x-input-error :messages="$errors->get('starting_date')" class="mt-2" />
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input id="end_date" type="date" class="form-control" name="ending_date" required>
                    <x-input-error :messages="$errors->get('ending_date')" class="mt-2" />
                </div>

                <div class="form-group">
                    <label for="reason">Reason for Leave</label>
                    <textarea id="reason" class="form-control" name="reason_for_leave" rows="4" required></textarea>
                    <x-input-error :messages="$errors->get('reason_for_leave')" class="mt-2" />
                </div>

                <button type="button" class="btn btn-primary" id="submitLeave">Submit</button>
                <button type="button" class="btn btn-primary" id="checkStatus">Request status</button>

            </form>

        </section>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#submitLeave').click(function() {
            var formData = $('#leaveForm').serialize();
            $.ajax({
                type: 'POST',
                url: '/leave-marked',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.hasOwnProperty('success')) {
                        alert(response.success);
                    }
                },
                errors: function(xhr, status, errors) {
                    alert(xhr.responseText);
                }
            });
        });

        $('#checkStatus').click(function() {
            $.ajax({
                type: 'GET',
                url: '/check-status', // Adjust the URL according to your route
                dataType: 'json',
                success: function(response)
                 {
                    if (response.hasOwnProperty('success')) {
                        alert(response.success);
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });
    });
</script>
