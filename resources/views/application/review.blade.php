<x-dashboard-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="bg-white p-6 md:p-8 shadow-md">

        <div class="card" style="width: 38rem; margin-left:30%;">
            <div class="card-body">
                <h5 class="card-title">Applicant Name: {{ $application->full_name }}</h5>
                <p class="card-text">
                    Age: {{ $application->age }}
                </p>
                <p class="card-text">
                    Email: {{ $application->email }}
                </p>
                <p class="card-text">
                    Phone: {{ $application->phone_number }}
                </p>
                <p class="card-text">
                    NID: {{ $application->nid_or_birth_certificate_no }}
                </p>
                <p class="card-text">
                    Relation: {{ $application->relation }}
                </p>
                <p class="card-text">
                    Prisoner Birthday: {{ $pin_data->birthdate }}
                </p>
                <p class="card-text">
                    *<b>{{ $pin_data->first_name }} {{ $pin_data->last_name }}</b> (PIN NO: {{ $application->pin_no }})
                    is at <u>{{ $jd[0]->name }}</u> Jail.
                </p>

                <label for="exampleFormControlInput1" class="form-label">Application Approval</label>
                <select class="form-select" aria-label="Default select example" style="margin-bottom:40px;">
                    <option selected>Spelect Here</option>
                    <option value="1">Approve</option>
                    <option value="2">Rejecte</option>
                </select>
                <div class="col-span-6 flex justify-end">
                    <x-button href="#" class="min-w-max">Submit</x-button>
                </div>
            </div>
        </div>
    </div>

</x-dashboard-layout>