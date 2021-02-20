<!DOCTYPE html>
<html>
    <head>
        <title>Todos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="author" content="sazzadhossian">
        <meta name="keywords" content="Todos to-do list, todo list, todos task, todos task list, task list, sazzadhossian, sazzad hossian, sazzad">
        <meta name="description" content="A to do list made using OOP PHP Javascript & Ajax">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.2.43/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pretty-checkbox/3.0.3/pretty-checkbox.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/0.4.0/modern-normalize.css">
        <link rel="stylesheet" type="text/css" href="assets/css/custom-style.css">
    </head>

    <body>

        <section class="main">

            <div id="section_container" class="container">

                <h1 class="section-title">todos</h1>

                <div id="todo_task_app" class="todo-app-2">

                    <div id="to_task_add" class="todo-task-add">
                        <button id="toggleAll" class="toggle-all" aria-label="Toggle all to do tasks"><span class="app-icon">&#x276F;</span></button>
                        <input id="addTaskInput" class="add-task-input" type="text" placeholder="What do you need to do?" aria-label="Enter your task" autofocus>
                    </div>

                    <ul id="todos" class="todos" aria-label="List of todos tasks"></ul>

                    <footer id="todoSummery" class="footer">

                        <label id="todosLeft" class="todos-left" aria-label="How many task are complated"></label>

                        <div id="todoSummeryButtons" class="btn-onfo">
                            <button id="show_all_tasks" class="app-btn active" aria-label="Show all tasks">All</button>
                            <button id="show_active_tasks" class="app-btn" aria-label="Show active tasks">Active</button>
                            <button id="show_completed_tasks" class="app-btn" aria-label="Show complated tasks">Completed</button>
                        </div>

                        <button id="deleted_comleted_btn" class="app-btn-delete-completed" aria-label="Remove completed tasks">Clear completed</button>

                    </footer>

                </div><!--/#todo_task_app -->

            </div><!--/#section_container -->

        </section>

        <script src="assets/js/jquery-3.5.1.min.js"></script>
        <script src="assets/js/script.js"></script>

    </body>
</html>