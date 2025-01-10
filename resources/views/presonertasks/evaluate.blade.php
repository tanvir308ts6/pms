<x-dashboard-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group w-100">
                    <form class="d-flex w-100" action="{{route('assignment.presonertask.evaluationData')}}"
                        method="GET">
                        <input type="text" name="pin_no" class="form-control" placeholder="Search With PIN first...."
                            required>
                        <button class="btn btn-outline-secondary" type="submit">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-12">
                @if(is_string($preasonartaskData))
                <p style="text-align:center;">{{ $preasonartaskData }}</p>
                @else
                {{-- Task data available --}}
                <div style="padding:20px;">
                    <h6>PIN: {{ $preasonartaskData['prisonar_task']->pin_no }}</h6>
                    @foreach ($preasonartaskData['prisonar_data'] as $prisoner)
                    <h6>Name: {{ $prisoner->first_name }} {{ $prisoner->last_name }}</h5>
                        <h6>Birthdate: {{ $prisoner->birthdate }}</h6>
                        @endforeach
                        @foreach ($preasonartaskData['task_data'] as $task)
                        <h6>Task: {{ $task->title }}</h6>
                        @endforeach
                        <h6>Description: {{ $preasonartaskData['prisonar_task']->description }}</h6>
                        <h6>Start At: {{ $preasonartaskData['prisonar_task']->start_at }}</h6>
                        <h6>End At: {{ $preasonartaskData['prisonar_task']->end_at }}</h6>

                        <form
                            action="{{ route('assignment.presonertask.updateEval', $preasonartaskData['prisonar_task']->id) }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label">Marks (out of 5)</label>
                                    <input type="number" name="marks" class="form-control" placeholder="Marks"
                                        aria-label="First name">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label">Task Result</label>
                                    <select class="form-select" name="task_status" aria-label="Default select example">
                                        <option selected>Select menu</option>
                                        <option value="1">Accepted</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                                <div class="col-md-12" style="margin-top:10px;">
                                    <label for="inputAddress" class="form-label">Remarks</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Your Comment"
                                        aria-label="Your Comment">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary" style="">Base class</button>
                        </form>
                </div>
                @endif
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</x-dashboard-layout>