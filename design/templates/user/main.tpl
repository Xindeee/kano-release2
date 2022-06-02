<form id ="mainForm">
    <p class='p-3 pb-0'>Представьтесь, пожалуйста</p>
    <div class="row p-3 pt-0">
        <div class="col-6">
            <div class="row">
                <div class="col-3">
                    <p>Категория пользователя:</p>
                </div>
                <div class="col-md">
                    <select class="form-select" style='cursor: pointer' id="category">
                        {foreach $categories as %key => %category}
                        <option value="{%category.title}">{%category.title}</option>
                        {/foreach}
                    </select>    
                </div>
            </div>
        </div>
        <div class="col-md">
          <div class="row">
                <div class="col-2">
                    <p>Фамилия И.О. </p>
                </div>
              <div class='col-10'>
                  <input required type="text" class=" form-control w-75" id ='userFIO'>
              </div>
            </div>
        </div>
    </div>

    <p class='p-3'>Сообщите ваше мнени по поводу функций и характеристик, которые могут быть реализованы в проекте.
        На основе него мы сможем расставить приоритеты разработки.</br>
        Вопросы по каждой из функций/характеристик однотипные. Все они уже видны на жкране. В конце опроса вы сможете
        оставить дополнительный комментарий, если это необходимо.</br>
        После ответа нажмите кнопку "Отправить".
    </p>

    <div class="p-3 questions">
        {foreach $functions as %key => %function}
        <div class="mb-5 function" name="{%function.id}">
            <p><b>{%key}. {%function.title}</b></p>
            <ul class="list-group">
                <li class="list-group-item">
                    <div clas="row p-0">
                        <div class="col-3" style="float: left">
                            Оцените, насколько это важно? От 1(совсем неважно) до 5 (очень важно)
                        </div>
                        <div class="col-6" style="float: left">
                            <select class="form-select" style='cursor: pointer' id="importance-{%function.id}">
                            <option selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div clas="row p-0">
                        <div class="col-3" style="float: left">
                            Как вы отнесетесь к проекту, если мы это сделаем?
                        </div>
                        <div class="col-6" style="float: left">
                            <select class="form-select" style='cursor: pointer' id="presence-{%function.id}">
                            <option selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div clas="row p-0">
                        <div class="col-3" style="float: left">
                            Как вы отнесетесь к проекту, если мы это НЕ сделаем?
                        </div>
                        <div class="col-6" style="float: left">
                            <select class="form-select" style='cursor: pointer' id="absence-{%function.id}">
                            <option selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        </div>
                    </div>
                </li> 
            </ul>
        </div>
        {/foreach}
    </div>
    <div class="p-3">
        <p><b>Ваш дополнительный комментарий</b></p>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px"></textarea>
            <label for="comment">Вы можете оставить любые мысли и предложения по функциям или характеристикам разрабатываемого продукта</label>
        </div>
    </div>
    <div class="p-3">
        <button href="#" class="btn btn-dark" onclick="send_answer()" >Отправить</button>
    </div>
</form>
