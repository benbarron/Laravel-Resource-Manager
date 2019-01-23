@extends('admin.layouts.app')

@section('title', 'Laravel Eclipse')


@section('content')
<!---main content----->
<div class="main">
  <div class="container">
    <div class="row">
      <div class="col s10 offset-s1 m10">
        <div class="row section-heading">
          <h2><b>New Model</b></h2>
        </div>
        <form action="/admin/create/model" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <br>
            <div class="input-field">
              <i class="fa fa-database prefix"></i>
              <input id="icon_prefix3" name="name" type="text" id="character_count" class="validate" value={{ old('name') }}>
              <label for="icon_prefix3">Model Name</label>
              @php
                if(isset($_GET['error']) && $_GET['error'] == "taken"){
                  echo "<span style='color:#aa0000;'>There is already a model with that name</span>";
                }
              @endphp
            </div>
          </div>
          <div class="row">
            <div class="input-field">
              <div class="switch">
                <label>
                  No Api Access
                  <input type="checkbox" name="api_access" id="profile-switch-input">
                  <span class="lever grey" id="profile-switch-lever"></span>
                  Api Access
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <h6><b>Model Cover Image</b></h6>
            <div class="input-field">
              <input id="icon_prefix3" name="image" type="file" id="character_count" class="validate">
            </div>
          </div>
          <div class="row">
            <table class="z-depth-2">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Default</th>
                  <th>Extra</th>
                </tr>
              </thead>
              <tbody id="edit-model-table">
                <tr>
                  <td>!</td>
                  <td>Integer</td>
                  <td>id</td>
                  <td></td>
                  <td>AutoIncrement</td>
                </tr>
                <tr>
                  <td>!</td>
                  <td>Integer</td>
                  <td>timeStamp</td>
                  <td>Current Timestamp</td>
                  <td></td>
                </tr>
                <tr>
                  <td>1 <input type="hidden" name="count-1" value="1"></td>
                  <td>
                    <select name="data-type-0" id="">
                      <option value="string">String</option>
                      <option value="integer">Integer</option>
                      <option value="text">Text</option>
                      <option value="float">Float</option>
                      <option value="boolean">Boolean</option>
                    </select>
                  </td>
                  <td>
                    <input type="text" name="name-0" value="">
                  </td>
                  <td>
                    <input type="text" name="default-0" value="">
                  </td>
                  <td>
                    <input type="text" name="extra-0" value="">
                  </td>
                </tr>
              </tbody>
              <tbody id="insert1"></tbody>
              <tbody id="insert2"></tbody>
              <tbody id="insert3"></tbody>
              <tbody id="insert4"></tbody>
              <tbody id="insert5"></tbody>
              <tbody id="insert6"></tbody>
              <tbody id="insert7"></tbody>
              <tbody id="insert8"></tbody>
              <tbody id="insert9"></tbody>
              <tbody id="insert10"></tbody>
              <tbody id="insert11"></tbody>
              <tbody id="insert12"></tbody>
            </table>
            <div class="row mt-50">
              <br>
              <div class="col s12 m3">
                <button type="submit" class="btn green z-depth-2 mr-20 mb-20">Create Model</button>
              </div>
              <div class="col s12 m3">
                <a id="add-column-to-model" class="btn grey darken-1 z-depth-2 mr-20 mb-20">Add Column</a>
              </div>
              <div class="col s12 m3">
                <a id="remove-column-to-model" class="btn red darken-1 z-depth-2 mr-20 mb-20">Remove Column</a>
              </div>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
