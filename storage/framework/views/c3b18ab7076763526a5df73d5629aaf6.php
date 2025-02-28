<?php $__env->startSection('content'); ?>
    

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">



      <!-- Main Content -->
      <div class="col-md-9 main-content">
          <h2>Todos</h2>
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="">Todos</h5>
                <a href="<?php echo e(route('todo.create')); ?>" class="btn btn-dark">create</a>
            </div>
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Action</th>
                            <th>DeadTime</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $todos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($todo->user_id == auth()->user()->id): ?>
                            <tr>
                                <td>
                                    <img width="90" class="rounded" src="<?php echo e(asset('images/' . $todo->image)); ?>" alt="image">
                                </td>
                                <td><?php echo e($todo->title); ?></td>
                                <td><?php echo e($todo->category->title); ?></td>
                                <td>
                                    <a href="<?php echo e(route('todo.show', ['todo' => $todo->id])); ?>"
                                        class="btn btn-sm btn-secondary">Show</a>
                                    <?php if($todo->status): ?>
                                        <button disabled class="btn btn-sm btn-outline-danger">Completed</button>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('todo.completed', ['todo' => $todo->id])); ?>" class="btn btn-sm btn-info">Done?</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    
                                    <?php echo e(\Morilog\Jalali\Jalalian::fromDateTime($todo->deadtime)->format('Y/m/d H:i')); ?>


                                
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($todos->links()); ?>


            </div>
        </div>
        <!-- Category Page -->
        <h2 class="mt-5">Categories</h2>
        <div class="card ">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="">Categories</h5>
                <a href="<?php echo e(route('category.create')); ?>" class="btn btn-dark">create</a>
            </div>
            <div class="card-body">
                <?php if(session()->has('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
            <?php endif; ?>
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->user_id == auth()->user()->id): ?>
                            <tr>
                                <td><?php echo e($category->title); ?></td>
                                <td class="d-flex">
                                    <a href="<?php echo e(route('category.edit', ['category' => $category->id])); ?>" class="btn btn-sm btn-secondary">Edit</a>
                                    <form action="<?php echo e(route('category.destroy', ['category' => $category->id])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger ms-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- User Detail -->
        <div id="user-detail" class="mt-5">
          <h2>User Detail</h2>
          <div class="card">
            <div class="card-body">
              <p><strong>Name:</strong> <?php echo e(Auth::user()->name); ?></p>
              <p><strong>Email:</strong> <?php echo e(auth()->user()->email); ?></p>
              
            </div>
          </div>
        </div>

        <!-- Update User -->
        <!--
        <div id="update-user" class="mt-5">
          <h2>Update User</h2>
          <div class="card">
            <div class="card-body">
              <form id="updateUserForm">
                <div class="mb-3">
                  <label for="userName" class="form-label" >Name</label>
                  <input type="text" class="form-control" id="userName" value="<?php echo e(Auth::user()->name); ?>">
                </div>
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="userEmail" value='<?php echo e(Auth::user()->email); ?>'>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="userPassword" value='<?php echo e(Auth::user()->password); ?>'>
                </div>
                <div class="mb-3">
                    <label for="userPasswordRepeat" class="form-label">Password confirm</label>
                  <input type="password" class="form-control" id="userPasswordRepeat" >
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
    -->
      </div>
    </div>
  </div>


  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <!-- Custom JS -->
  <script>
    // Todo List Functionality
    document.getElementById('todoForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const todoInput = document.getElementById('todoInput');
      const todoList = document.getElementById('todoList');
      if (todoInput.value.trim() !== '') {
        const li = document.createElement('li');
        li.textContent = todoInput.value;
        todoList.appendChild(li);
        todoInput.value = '';
      }
    });

    // Category List Functionality
    document.getElementById('categoryForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const categoryInput = document.getElementById('categoryInput');
      const categoryList = document.getElementById('categoryList');
      if (categoryInput.value.trim() !== '') {
        const li = document.createElement('li');
        li.textContent = categoryInput.value;
        categoryList.appendChild(li);
        categoryInput.value = '';
      }
    });

    // Update User Functionality
    document.getElementById('updateUserForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const userName = document.getElementById('userName').value;
      const userEmail = document.getElementById('userEmail').value;
      const userRole = document.getElementById('userRole').value;
      alert(`User Updated:\nName: ${userName}\nEmail: ${userEmail}\nRole: ${userRole}`);
    });
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/iliarezaei/New Volume/laravel/todo-app/resources/views/auth/dashboard.blade.php ENDPATH**/ ?>