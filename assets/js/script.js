/**
 * script.js
 * App Custom Js file
 * Version - 1.0.1 
 **/
(function($){

    // get todos
    getAllTodos();

    // define some selector
    var addTaskInput = $("#addTaskInput");
    var todoTaskList = $("#todos");

    var allTasksElement      = $("#show_all_tasks");
    var showActiveTasks      = $("#show_active_tasks");
    var showCompletedTasks   = $("#show_completed_tasks");

    var todoSummery = $("#todoSummery");
    var todoMainWrapper = $("#todo_task_app");

    // define todo task handaler
    addTaskInput.on("keyup", function (event) {
        if (event.key === "Enter") {
          addTodoTask();
        }
    });

    /**
     * Single todo for active/delete/complete
     */
    todoTaskList.on("click", function (event) {
        // Get the element that was clicked.
        var elementClicked = event.target;
        // Check if elementClicked is a delete button.
        if (elementClicked.classList.contains("delete-button")) {
            var elDelete = $(elementClicked);

            deleteTodo(elDelete.prev());
        }
        // for check box
        else if (elementClicked.classList.contains("checkbox")) {
            var elChecked = $(elementClicked);
            var elTodo = elChecked.parent().next();

            if(elTodo.hasClass("todo-checked-text")){
                // for completed to active
                updateTodo(elTodo, 'active');
                elTodo.removeClass("todo-checked-text");
            }else{
                // for active to completed
                updateTodo(elTodo, 'completed');
                elTodo.addClass("todo-checked-text");
            }
        }
    });

    // for edit
    todoTaskList.on("focusin", function(event){
        var elementClicked = event.target;

        if(elementClicked.classList.contains("todo-text")){
            var elTodo = $(elementClicked);
            elTodo.css("border", "1px solid #bfbfbf");
            elTodo.css("box-shadow", "0px 0px 3px 1px #cccccc inset");
            elTodo.css("padding-left", "10px");
        }
    });

    // for update
    todoTaskList.on("focusout", function(event){
        var elementClicked = event.target;

        if(elementClicked.classList.contains("todo-text")){
            var elTodo = $(elementClicked);
            elTodo.css("border", "");
            elTodo.css("box-shadow", "");
            elTodo.css("padding-left", "");
            updateTodo(elTodo);
        }
    });

    // show todos
    allTasksElement.on('click', function(event){
        event.preventDefault();
        $(this).addClass('active');
        showActiveTasks.removeClass('active');
        showCompletedTasks.removeClass('active');

        var todos = $('li.todo');
        showAllTodos(todos);
    });

    // for active todos
    showActiveTasks.on('click', function(event){
        event.preventDefault();
        $(this).addClass('active');
        allTasksElement.removeClass('active');
        showCompletedTasks.removeClass('active');
        
        var todos = $('li.todo');
        showActiveTodos(todos);
    });

    // for completed todos
    showCompletedTasks.on('click', function(event){
        event.preventDefault();
        $(this).addClass('active');
        allTasksElement.removeClass('active');
        showActiveTasks.removeClass('active');
        
        var todos = $('li.todo');
        showCompletedTodos(todos);
    });

    // for delete
    var elDeleteCompleted = $('#deleted_comleted_btn');
    if(elDeleteCompleted.length > 0){
        elDeleteCompleted.on('click', function(event){
            event.preventDefault();
            deleteCompletedTodos();
        });
    }

    // add new item
    function addTodoTask(){
        var data = {
            "action": "insert",
            "data": {
                "name": addTaskInput.val(),
            },
        };
        $.ajax({
            url: 'app/AjaxController.php',
            type: "post",
            data: data,
            dataType: "json",
            success: function(response) {
                displayTodos(response);
                addTaskInput.val('');
                updateTodoUi();
            }
        });
    }

    // for update item
    function updateTodo(selector, status = 'active'){
        var data = {
            "action": "update",
            "data": {
                "id": selector.attr('data-id'),
                "name": selector.text(),
                "status": status,
            },
        };
        $.ajax({
            url: 'app/AjaxController.php',
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                updateTodoUi();
            }
        });
    }

    // for delete item
    function deleteTodo(selector){
        var data = {
            "action": "delete",
            "data": {
                "id": selector.attr('data-id'),
                "name": selector.text(),
            },
        };
        $.ajax({
            url: 'app/AjaxController.php',
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                //console.log(response);
            }
        });

        selector.prev().remove();
        selector.next().remove();
        selector.remove();

        updateTodoUi();

    }

    // for delete completed item
    function deleteCompletedTodos(){
        var data = {
            "action": "deleteCompleted",
        };
        $.ajax({
            url: 'app/AjaxController.php',
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                getAllTodos();
                updateTodoUi();
            }
        });
    }

    // for display items
    function displayTodos(data){

        var todoLi = document.createElement("li");

        var checkbox = createCheckbox(data);
        var todoLabel = createTodoLabel(data);
        var deleteButton = createDeleteButton();

        todoLi.className = "todo";
        todoLi.appendChild(checkbox);
        todoLi.appendChild(todoLabel);
        todoLi.appendChild(deleteButton);
        todoTaskList.append(todoLi);

    }

    // Define get all todos
    function getAllTodos(){
        $.ajax({
            url: 'app/AjaxController.php',
            type: "GET",
            success: function(response) {
                var todos = JSON.parse(response);
                //console.log(todos);
                $('#todos').empty();
                $.each( todos, function(index, element){
                    displayTodos(element);
                });
                updateTodoUi();
            }
        });
    }

    // define show all todos
    function showAllTodos(todos) {
        $.each( todos, function(idx, item){
            $(this).show();
        });
    }

    // define show active todos
    function showActiveTodos(todos) {
        $.each( todos, function(idx, item){
            if($(this).find('.todo-text').hasClass("todo-checked-text")){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    }

    // define show completed todos
    function showCompletedTodos(todos) {
        $.each( todos, function(idx, item){
            if(!$(this).find('.todo-text').hasClass("todo-checked-text")){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    }

    // define update todos for 
    function updateTodoUi(){

        var todos = $('.todo-text').length;
        var todosCompleted = $('.todo-checked-text').length;
        var elLeftTodos = ( todos - todosCompleted );
        var elleftTodosLabel = $('#todosLeft');
        var elDeleteCompletedButton = $('#deleted_comleted_btn');

        if(todos > 0){
            todoSummery.show();
            todoMainWrapper.css('grid-template-rows', '60px 1fr 45px');
        }else{
            todoSummery.hide();
            todoMainWrapper.css('grid-template-rows', '60px 1fr 0px');
        }

        if( elLeftTodos > 0 ){
            elleftTodosLabel.text(elLeftTodos+((elLeftTodos > 1)? ' items': ' item')+' left');
        }else{
            elleftTodosLabel.text('');
        }

        if(todosCompleted > 0){
            elDeleteCompletedButton.show();
        }else{
            elDeleteCompletedButton.hide();
        }

    }

    // for checkbox controll
    function createCheckbox(todo) {
        var checkboxMain    = document.createElement("div");
        var checkbox        = document.createElement("input");
        var checkboxState   = document.createElement("div");
        var checkboxIcon    = document.createElement("i");
        var checkboxLabel   = document.createElement("label");
    
        checkboxMain.className = "pretty p-icon p-round";
        checkboxState.className = "state";
        checkboxIcon.className = "icon mdi mdi-check mdi-18px";
    
        checkbox.type = "checkbox";
        checkbox.className = "checkbox";
    
        checkboxState.appendChild(checkboxIcon);
        checkboxState.appendChild(checkboxLabel);
        checkboxMain.appendChild(checkbox);
        checkboxMain.appendChild(checkboxState);

        if(todo.status == 'completed'){
            checkbox.click();
        }

        return checkboxMain;
    }

    // for todo labels
    function createTodoLabel(todo) {
        var todoLabel = document.createElement("label");
        todoLabel.textContent = todo.name;
        todoLabel.className = "todo-text";
        if(todo.status == 'completed'){
            todoLabel.className = todoLabel.className+" todo-checked-text";
        }
        todoLabel.setAttribute("data-id", todo.id);
        todoLabel.contentEditable = true;
        return todoLabel;
    }

    // for todo delete action
    function createDeleteButton() {
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "×";
        deleteButton.className = "delete-button";
        return deleteButton;
    }


})(jQuery);