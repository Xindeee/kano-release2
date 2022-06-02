/* 
 * Работа с опросами: Создать\Редактировать
 */


function createIntv() {
     const isPublic = document.querySelector('#isPublic').checked;
        
    var fcdata = $('#invForm').serializeArray()
   // var check = new Object({"name":"isPublic","value":isPublic});
    
   // let data = {fdata, check};
    //ata['isPublic'] = isPublic
    
    
    $.ajax({
        async: false,
        type: "POST",
        data:fcdata
            
    })
    window.location.search="?show_mode_selection"
}

function save_edit_poll(poll_id) {
    const isPublic = document.querySelector('#isPublic').checked;
        
    var fcdata = $('#invForm').serializeArray()
  
    $.ajax({
        async: false,
        type: "POST",
        data:fcdata,
        success: function(msg) {
            //alert('Успех');
        }
    })
    
    
}


var countOfFields = 1; // Текущее число полей
var curFieldNameId = 1; // Уникальное значение для атрибута name
var maxFieldLimit = 100; // Максимальное число возможных полей

function deleteField(a) {
  // Получаем доступ к ДИВу, содержащему поле
    var contDiv = a.parentNode;
  // Удаляем этот ДИВ из DOM-дерева
  contDiv.parentNode.removeChild(contDiv);
  // Уменьшаем значение текущего числа полей
  countOfFields--;
  // Возвращаем false, чтобы не было перехода по сслыке
  return false;
}

function addFieldCat() {
  // Проверяем, не достигло ли число полей максимума
  if (countOfFields >= maxFieldLimit) {
    alert("Число полей достигло своего максимума = " + maxFieldLimit);
    return false;
  }
  // Увеличиваем текущее значение числа полей
  countOfFields++;
  // Увеличиваем ID
  curFieldNameId++;
  // Создаем элемент ДИВ
  var div = document.createElement("div");
  // Добавляем HTML-контент с пом. свойства innerHTML
  div.innerHTML = '<p><div class="d-flex"> <input type="text" class="form-control w-100" name="category[]"> <a href="#" class="ms-2 d-flex justify-content-center align-items-center px-3 py-1 bg-dark text-white rounded" onclick="return deleteField(this)">X</a></div></p>'
   // div.innerHTML = '<input name="name_" + curFieldNameId + "" type="text" /> <a onclick="return deleteField(this)" href="#">[X]</a>';
  // Добавляем новый узел в конец списка полей
  document.getElementById("parentId").appendChild(div);
  // Возвращаем false, чтобы не было перехода по сслыке
  return false;
}

function addFieldFun() {
  // Проверяем, не достигло ли число полей максимума
  if (countOfFields >= maxFieldLimit) {
    alert("Число полей достигло своего максимума = " + maxFieldLimit);
    return false;
  }
  // Увеличиваем текущее значение числа полей
  countOfFields++;
  // Увеличиваем ID
  curFieldNameId++;
  // Создаем элемент ДИВ
  var div = document.createElement("div");
  // Добавляем HTML-контент с пом. свойства innerHTML
  div.innerHTML = '<p><div class="d-flex"> <input type="text" class="form-control w-100" name="functions[]"> <a href="#" class="ms-2 d-flex justify-content-center align-items-center px-3 py-1 bg-dark text-white rounded" onclick="return deleteField(this)">X</a></div></p>'
  document.getElementById("parent").appendChild(div);
  // Возвращаем false, чтобы не было перехода по сслыке
  return false;
}
