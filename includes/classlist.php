<div class="col-md-3">
    <a href="index.php" class="form-control btn btn-danger">
        Home
    </a><br><br>

    <a href="classselect.php" class="form-control btn btn-danger">
        Result
    </a><br><br>
                
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>List Class</h4>
        </div>

        <div class="panel-body">
            <ul class="list-group">
            <?php
                $classes = $class->getAllClasses();
                foreach ($classes as $class) {
                    echo '<li class="list-group-item">
                            <a href="listsubject.php?classname='.$class->class_name.'"
                             style="text-decoration: none; color: black">
                               '.$class->class_name.'
                            </a>
                        </li>';
                }
            ?>
            </ul>
            
        </div>
    </div>
</div>
