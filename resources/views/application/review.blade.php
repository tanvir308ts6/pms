<x-dashboard-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="bg-white p-6 md:p-8 shadow-md" style="display:flex;">
        
        <div class="card" style="width: 38rem;">
            @if(Auth::user()?->role?->id == 3)
            <h2 class="card-title" style="text-align:center; margin-top:20px; "><b>Visitor Pass</b></h2>
            @endif

            <div class="card-body" id="printable-content">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h5 class="card-title">
                                    @if(Auth::user()?->role?->id == 3)
                                    Visitor
                                    @else
                                    Applicant
                                    @endif
                                    Name: {{$application->full_name}}</h5>
                                <p class="card-text">
                                    Age: {{$application->age}}
                                </p>
                                <p class="card-text">
                                    Email: {{$application->email}}
                                </p>
                                <p class="card-text">
                                    Phone: {{$application->phone_number}}
                                </p>
                                <p class="card-text">
                                    NID: {{$application->nid_or_birth_certificate_no}}
                                </p>
                                <p class="card-text">
                                    Relation: {{$application->relation}}
                                </p>
                                <p class="card-text">
                                    <b>{{$pin_data->first_name}} {{$pin_data->last_name}}</b> (PIN NO:
                                    {{$application->pin_no}}) is at
                                    <u>{{$jd[0]->name}}</u> Jail.
                                </p>
                                <p class="card-text">
                                    Prisoner Birthday: {{$pin_data->birthdate}}
                                </p>
                                @if(Auth::user()?->role?->id == 3)
                                <p class="card-text">
                                    Approval Status:

                                    @if($application->status === 1)
                                    <b><span style="color:Green">Approved</span></b>
                                    @elseif($application->status === 0)
                                    <b><span style="color:red">Rejected</span></b>
                                    @else
                                    <b><span style="color:orange">Panding</span></b>
                                    @endif
                                </p>
                                @else
                                <form action="{{ route('application.update', $application->id) }}" method="POST">
                                    @csrf
                                    <label for="status" class="form-label">Application Approval:</label>
                                    <select class="form-select" name="status" id="status" required>
                                        <option value="1" {{ $application->status == 1 ? 'selected' : '' }}>Approved
                                        </option>
                                        <option value="0" {{ $application->status == 0 ? 'selected' : '' }}>Rejected
                                        </option>
                                    </select>
                                    <button class="btn btn-success" type="submit"
                                        style="margin-top:30px;">Submit</button>
                                </form>
                                @endif
                            </td>
                            <td>
                                <div class="qr-code" style="margin-left:26px;">
                                    {!! QrCode::size(150)->generate(json_encode([
                                    'Visitor Name' => $application->full_name,
                                    'Age' => $application->age,
                                    'Email' => $application->email,
                                    'Phone' => $application->phone_number,
                                    'NID' => $application->nid_or_birth_certificate_no,
                                    'Relation' => $application->relation,
                                    'Pin' => $application->pin_no,
                                    'Jail Name' => $jd[0]->name,
                                    'Approval Status' => $application->status === 1 ? 'Approved' : ($application->status
                                    === 0 ? 'Rejected' : 'Pending'),
                                    ])) !!}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if(Auth::user()?->role?->id == 3 && $application->status == 1)                           
        <div class="mt-3">
            <button class="btn btn-primary" onclick="printCard()" style="margin-left:30%;">
                <x-ionicon-print class="h-6 w-6 text-red-600" />
            </button>
        </div>
        @endif
    </div>



    <script>
    function printCard() {
        // Select the elements you don't want to print
        const relationElement = document.querySelector('p.card-text:nth-of-type(6)');
        const pinElement = document.querySelector('p.card-text:nth-of-type(7)');
        const birthdayElement = document.querySelector('p.card-text:nth-of-type(8)');

        // Temporarily hide these elements
        relationElement.style.display = 'none';
        pinElement.style.display = 'none';
        birthdayElement.style.display = 'none';

        // Select the printable content
        const printableContent = document.getElementById('printable-content');
        if (!printableContent) {
            console.error('Printable content not found');
            return;
        }
        const printContents = printableContent.innerHTML;
        const originalContents = document.body.innerHTML;

        // Replace the body content with the printable content
        document.body.innerHTML = printContents;
        window.print(); // Trigger the print dialog

        // Restore the original content and styles
        document.body.innerHTML = originalContents;
        window.location.reload();
    }
    </script>

</x-dashboard-layout>