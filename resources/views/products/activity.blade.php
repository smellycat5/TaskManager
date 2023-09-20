@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Activities</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th>No.</th> --}}
                    <th>User</th>
                    <th>Event</th>
                    <th>Product</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        {{-- <td>{{ $activity->number }}</td> --}}
                        <td>{{ $activity->causer->name }}</td>
                        <td>{{ $activity->event }}</td>
                        {{-- @dd($activity->properties) --}}
                        <td>

                            @foreach ($activity['properties'] as $property)
                            @if (isset($property['name']))
                            <p>Name:{{ $property['name'] }}</p>
                            <p>Price:{{ $property['price'] }}</p>
                            {{-- <p>{{ $property['details'] }}</p> --}}

                            @break
                            @endif
                            @endforeach
                        </td>
                        <td>{{ $activity->created_at }}</td>

                    {{-- <td>{{ ($activity->properties[1]['name']) }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
