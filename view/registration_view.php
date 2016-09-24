<div class="container "> 
<form action="/users/_register" method="post" enctype="multipart/form-data" class="form-registration center-block" role="form">
<h2 class="center-block">Реєстрація</h2>
  <div class="form-group">
    <label for="inputName">Им'я</label>
    <input type="text" name="name"  class="form-control" id="inputName" placeholder="Имя" required>
  </div>

  <div class="form-group">
    <label for="inputEmail3">Імейл</label>
    <input type="email" name="email"  class="form-control" id="inputEmail3" placeholder="Імейл" required>
  </div>
  <div class="form-group">
    <label for="inputPassword3">Пароль</label>
    <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Пароль" required>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Вибрати фото</label>
    <input type="file" name="file_name" id="exampleInputFile">
  </div>

      <button type="submit" class="btn btn-primary btn-block">Увійти</button>
 </form>

</div>