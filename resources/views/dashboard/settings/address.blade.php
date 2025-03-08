@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header"><h4>Ministry Address List</h4></div>
              <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
            @endif
                      <a class="btn btn-lg btn-primary" style="float: right;" href="{{ route('address.create') }}">Add New Address</a>

                  <br><br><br>
                  <table class="table table-striped table-bordered datatable">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>ADD Line - 1 (Name)</th>
                              <th>ADD Line - 2</th>
                              <th>ADD Line - 3</th>
                              <th>ADD Line - 4</th>
                              <th>ADD Line - 5</th>
                              <th>Edit</th>
                              <th>Delete</th>
                              <th>Print Envelope</th>

                          </tr>
                      </thead>
                      <tbody>
                          @foreach($addressList as $addressListItem)
                              <tr>
                                <td>
                                    {{ $addressListItem->id }}
                                </td>
                                  <td>
                                      {{ $addressListItem->fldAddLine1 }}
                                  </td>
                                  <td>
                                      {{ $addressListItem->fldAddLine2}}
                                  </td>
                                  <td>
                                      {{ $addressListItem->fldAddLine3 }}
                                  </td>
                                  <td>
                                      {{ $addressListItem->fldAddLine4 }}
                                  </td>
                                  <td>
                                    {{ $addressListItem->fldAddLine5 }}
                                </td>
                                <td>
                                    <a href="{{ route('address.edit', $addressListItem->id ) }}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <a href="{{ route('address.delete', $addressListItem->id ) }}" class="btn btn-danger">Delete</a>
                                </td>
                                <td>
                                    <a href="{{ route('print-ministry-address', $addressListItem->id) }}" target="_blank">
                                        <span class="btn btn-dark">Print Envelope</span>
                                    </a>
                                </td>
                                  {{-- <td>
                                      <a class="btn btn-success" href="{{ route('roles.up', ['id' => $role->id]) }}">
                                          <i class="cil-arrow-thick-top"></i>
                                      </a>
                                  </td>
                                  <td>
                                      <a class="btn btn-success" href="{{ route('roles.down', ['id' => $role->id]) }}">
                                          <i class="cil-arrow-thick-bottom"></i>
                                      </a>
                                  </td>
                                  <td>
                                      <a href="{{ route('roles.show', $role->id ) }}" class="btn btn-primary">Show</a>
                                  </td>

                                  <td>
                                  <form action="{{ route('roles.destroy', $role->id ) }}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button class="btn btn-danger">Delete</button>
                                  </form>
                                  </td> --}}
                              </tr>
                          @endforeach
                      </tbody>
                  </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')

@endsection
