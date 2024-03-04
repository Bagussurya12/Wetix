<nav class="nav flex-column">
  @foreach($list AS $row)
  <a href="#" class="nav-link {{$isActive($row['label']) ? 'active' : ' '}}">
  {{$row['label']}}</a>
  @endforeach

    <!-- <br>
    {{$active}}
    <br> -->

</nav>