<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200">

    <div class="container mx-auto mt-10 p-2">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-bold">Roles List</h2>
            <button onclick="openModal('addRoleModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add Role</button>
        </div>

        @session ('success')
            <div class="bg-green-200 text-green-800 p-3 mb-4">{{ session('success') }}</div>
        @endsession

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-3 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow-md p-4">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="p-3 border-b border-gray-600">ID</th>
                        <th class="p-3 border-b border-gray-600">Name</th>
                        <th class="p-3 border-b border-gray-600">Permissions</th>
                        <th class="p-3 border-b border-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="hover:bg-gray-700">
                            <td class="p-3 border-b border-gray-700">{{$role->id}}</td>
                            <td class="p-3 border-b border-gray-700">{{$role->name}}</td>
                            <td class="p-3 border-b border-gray-700">0</td>
                            <td class="p-3 border-b border-gray-700">
                                <button onclick="openEditModal({{$role->id}}, '{{$role->name}}')" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                                <button onclick="openDeleteModal({{$role->id}})" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Role Modal -->
    <div id="addRoleModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-gray-800 p-6 rounded shadow-md w-96">
            <h3 class="text-xl font-bold mb-4">Add Role</h3>
            <form action="" method="POST">
                @csrf
                <input type="text" name="name" value="{{old('name')}}" placeholder="Role Name" class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal('addRoleModal')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div id="editRoleModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-gray-800 p-6 rounded shadow-md w-96">
            <h3 class="text-xl font-bold mb-4">Edit Role</h3>
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editRoleId">
                <input type="text" id="editRoleName" name="name" placeholder="Role Name" class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal('editRoleModal')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteRoleModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-gray-800 p-6 rounded shadow-md w-96">
            <h3 class="text-xl font-bold mb-4">Delete Role?</h3>
            <p>Are you sure you want to delete this role?</p>
            <form id="deleteRoleForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" onclick="closeModal('deleteRoleModal')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openEditModal(id, name) {
            document.getElementById('editRoleId').value = id;
            document.getElementById('editRoleName').value = name;
            document.getElementById('editRoleForm').action = `/roles/${id}`;
            openModal('editRoleModal');
        }

        function openDeleteModal(id) {
            document.getElementById('deleteRoleForm').action = `/roles/${id}`;
            openModal('deleteRoleModal');
        }
    </script>


</body>
</html>