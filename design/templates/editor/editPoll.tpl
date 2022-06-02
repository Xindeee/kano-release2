<div class="container mt-5">
    <div class="row font-weight-bold">ЛЕНТА СНИМКОВ ДОСКИ</div>

    <div class="row">

        <form id="invForm" method="post" class="p-0" action="javascript:void(null);" >
        <label class="d-flex mt-3">Название проекта
          <input type="text" class="ms-auto form-control w-75" name = 'intvName' value="{$name}">
        </label>
        <label class="d-flex mt-3">Краткое описание проекта
          <input type="text" class="ms-auto form-control w-75" name = 'description' value="{$description}">
        </label>
        <label class="d-flex mt-3 w-50">
          Категории пользователей
          <div class="d-flex w-50 ms-auto flex-column">
            <div class="d-flex flex-column mb-3" id="parentId">
                {foreach $categories as %key => %category}
                <p>
                    <div class="d-flex"> 
                        <input type="text" class="form-control w-100" name="category[]" value="{%category.title}"> 
                            <a href="#" class="ms-2 d-flex justify-content-center align-items-center px-3 py-1 bg-dark text-white rounded" onclick="return deleteField(this)">
                                X
                            </a>
                    </div>
                </p>
                {/foreach}
            </div>
            <a href="#"  onclick="return addFieldCat()" class="btn btn-dark w-50 mt-2">Добавить</a>
          </div>
        </label>
        
        <label class="d-flex mt-3 w-50">
            Функции / характеристики
            <div class="d-flex w-50 ms-auto flex-column">
              <div class="d-flex flex-column mb-3" id="parent">    
                  {foreach $functions as %key => %function}
                <p>
                    <div class="d-flex"> 
                        <input type="text" class="form-control w-100" name="functions[]" value="{%function.title}"> 
                            <a href="#" class="ms-2 d-flex justify-content-center align-items-center px-3 py-1 bg-dark text-white rounded" onclick="return deleteField(this)">
                                X
                            </a>
                    </div>
                </p>
                {/foreach}
              </div>
              <a href="#" onclick="return addFieldFun()" class="btn btn-dark w-50 mt-2">Добавить</a>
            </div>
        </label>
        
        <label class="d-flex my-3 w-100">
          Публичный / закрытый
          <div class="d-flex w-75 ms-auto flex-column">
            <div class="form-check">
              <input class="form-check-input" id='isPublic' type="checkbox" value="" />
            </div>
          </div>
        </label>
        
        <p><a href="#" type="submit" value="Сохранить" name="done" class="btn btn-dark" onclick="save_edit_poll({$id})">Сохранить</a></p>
        <input type="hidden" name = 'action' value="save_poll_edits">
      </form>
    </div>
</div>