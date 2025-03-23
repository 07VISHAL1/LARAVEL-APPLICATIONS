<x-app-layout>
<style>
    
    h1
    {
        margin-left: 6rem;
    }
    h2
    {
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
               
                <form method="POST" action="/leave-updated">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group">
                        <label for="leave_type">Leave Type</label><br>
                        <input id="type" type="text" class="type" name="type" readonly value="{{$user->type}}" required>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />

                            <!-- Add more leave types as needed -->
                        </select>
                    </div>
                    <input type="hidden"  value="{{$user->id}}">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input id="start_date" type="date" class="form-control" name="starting_date" readonly value="{{$user->starting_date}}" required>
                        <x-input-error :messages="$errors->get('starting_date')" class="mt-2" />

                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input id="end_date" type="date" class="form-control" name="ending_date" readonly value="{{$user->ending_date}}" required>
                        <x-input-error :messages="$errors->get('ending_date')" class="mt-2" />

                    </div>
                    <div class="form-group">
                    <label for="reason">Reason for Leave</label>
                    <textarea id="reason_for_leave" class="form-control" name="reason_for_leave" readonly required>{{ $user->reason_for_leave }}</textarea>
                    <x-input-error :messages="$errors->get('reason_for_leave')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="leave_decision">Leave status</label><br>
                            <select id="leave_decision" class="form-control" name="status" required>
                                <option value="">Select decision</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Reject</option>
                            </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
