@extends('dashboard.base')

@section('content')


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h4>egitdit Address</h4></div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                <form method="POST" action="{{ route('address.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $editAddresses->id }}"/>
                    <table class="table table-bordered datatable">
                        <tbody>
                            <tr>
                                <th>
                                    Address Line - 1
                                </th>
                                <td>
                                    <input class="form-control" name="addLine1" type="text" value="{{ $editAddresses->fldAddLine1 }}"/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Address Line - 2
                                </th>
                                <td>
                                    <input class="form-control" name="addLine2" type="text" value="{{ $editAddresses->fldAddLine2 }}"/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Address Line - 3
                                </th>
                                <td>
                                    <input class="form-control" name="addLine3" type="text" value="{{ $editAddresses->fldAddLine3 }}"/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Address Line - 4
                                </th>
                                <td>
                                    <input class="form-control" name="addLine4" type="text" value="{{ $editAddresses->fldAddLine4 }}"/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Address Line - 5
                                </th>
                                <td>
                                    <input class="form-control" name="addLine5" type="text" value="{{ $editAddresses->fldAddLine5 }}"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a class="btn btn-primary" href="{{ route('address.list') }}">Return</a>
                </form>
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
