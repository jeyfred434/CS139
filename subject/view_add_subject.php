<div class="modal fade" id="add_subject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="subject/add_subject.php" method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="Subject Code" required>
                        <label for="floatingInput">Subject Code</label>
                    </div>
                    
                    <div class="form-floating mb-3">

                        <?php
                            $database = new Connection();
                            $db = $database->open();
                        ?>
                        <select class="form-select" id="course_id" name="course_id" aria-label="Floating label select example">
                            <?php
                                $sql = "SELECT * FROM course";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $courses = $stmt->fetchAll();
                            ?>
                            <option selected></option>
                            <?php foreach($courses as $course): ?>
                                <option value="<?= $course['id']; ?>"><?= $course['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="floatingSelect">Course</label>
                        <?php
                            $database->close();
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="description" name="description" placeholder="description" required>
                        <label for="floatingInput">Course Description</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="units" name="units" placeholder="Total Units" required>
                        <label for="floatingInput">Total Units</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="components" name="components" placeholder="With Lab Components" required>
                        <label for="floatingInput">With Lab Components</label>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
