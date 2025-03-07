<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200">
    <div class="container mx-auto mt-10 p-2">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold">User Management</h1>
            <a href="/profile" class="bg-green-600 text-white px-4 py-2 rounded h-fit">Profile</a>
        </div>
        
        @session('success')
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endsession

        <div class="bg-gray-800 rounded-lg shadow-md p-4">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="p-3 border-b border-gray-600">#</th>
                        <th class="p-3 border-b border-gray-600">Name</th>
                        <th class="p-3 border-b border-gray-600">Email</th>
                        <th class="p-3 border-b border-gray-600">Verified</th>
                        <th class="p-3 border-b border-gray-600">Role</th>
                        <th class="p-3 border-b border-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-700">
                            <td class="p-3 border-b border-gray-700">{{$user->id}}</td>
                            <td class="p-3 border-b border-gray-700">{{$user->name}}</td>
                            <td class="p-3 border-b border-gray-700">{{$user->email}}</td>
                            <td class="p-3 border-b border-gray-700 text-{{$user->account_verified_at ? 'green' : 'red'}}-700">{{$user->account_verified_at ? 'Yes' : 'No'}}</td>
                            <td class="p-3 border-b border-gray-700">{{$user->roles->pluck('name')->implode(', ')}}</td>
                            <td class="p-3 border-b border-gray-700">
                                <button class="bg-blue-600 text-white px-4 py-2 rounded" onclick="openRoleModal({{$user->id}}, {{json_encode($user->roles->pluck('id'))}})">Change Role</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Change Role Modal -->
    <div id="roleModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-gray-800 p-6 rounded shadow-md w-96">
            <h2 class="text-xl font-semibold mb-4">Change User Role</h2>
            <form id="roleForm" action="" method="get">
                <select name="role_ids[]" id="roleSelect" multiple  class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-gray-600 text-white px-4 py-2 rounded mr-2" onclick="closeRoleModal()">Cancel</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRoleModal(userId, userRoles) {
          document.getElementById('roleForm').action = `/users/${userId}/change-role`;

          let roleSelect = document.getElementById('roleSelect');
          roleSelect.querySelectorAll("option").forEach(option => {
            option.selected = userRoles.includes(parseInt(option.value));
          });
          document.getElementById('roleModal').classList.remove('hidden');
        }
        
        function closeRoleModal() {
          document.getElementById('roleModal').classList.add('hidden');
        }
    </script>
</body>
</html>