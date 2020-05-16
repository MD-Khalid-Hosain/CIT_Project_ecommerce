<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="{{ route('arithmatic.store') }}" method="post">
      @csrf
      <input type="text" name="first">
      <input type="text" name="second">
      <button type="submit" name="button">click</button>
    </form>
  </body>
</html>
