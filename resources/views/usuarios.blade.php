<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

         <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

         

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        
         
       
        
        @vite('resources/css/app.css')

        <style>
            
            .popup-overlay {
                display: none; /* Hidden by default */
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000; /* Ensure it's on top */
            }

            .popup-content {
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                text-align: center;
                position: relative;
            }

            #closePopupBtn {
                margin-top: 15px;
                padding: 8px 15px;
                cursor: pointer;
            }
            .popup-overlay{
                display:none;
            }

        </style>
        
    </head>
    <body class="antialiased">
         
        @if (auth()->check())
            <div class="mainmenu">
                <li class="lista">
                    <ul><a href="archivos">Panel de usuario</a></ul>
                    <ul><a href="usuarios">Panel de administrador</a></ul>
                </li>
            </div>
        @else
            <script>window.location.href = "{{ route('login')}}"; </script>
        @endif


        <div id="popupOverlay"  class="popup-overlay">
            <div class="popup-content">
                <h2>Editar Usuario</h2>
                <div class="c_role">
                    <h3>Editar Rol De Usuario</h3>
                    <form id="editRole" method="post" > 
                        <label for="edit_role">Rol:</label>
                        <select id="edit_role" name="edit_role">
                            <option value="Usuario">Usuario</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                        <input   value="" type="hidden" id="edit_user_role_id" name="edit_user_role_id">
                        <button type="submit">Guardar Rol De Usuario</button>
                    </form>
                </div>

                <div class="c_cuota">
                    <h3>Editar Cuota De Usuario</h3>

                    <form id="editCuota">
                        <label for="cuota">Cuota Usuario:</label>
                        <div class="inputcuota">
                        <input id="cuota" name="cuota" type="number" step="50" min="0" max="800000" value="">
                        Kb
                        </div>
                    
                    <button type="submit">Guardar Couta De Usuario</button>
                    </form>
                    
                </div>

                <div class="c_grupos">
                    <h3>Editar Grupos De Usuario</h3>

                    <form id="editGrupos">
                    <div id="container_div"></div>
                    
                    <button type="submit">Guardar Grupos De Usuario</button>
                    </form>
                    
                </div>
        
                <button id="closePopupBtn">Close</button>
            </div>
        </div>

        
        <h1>Usuarios & Gestion De Grupos</h1>

        <div class="users_config">

            <div class="user_config_container">

                <h2>Gestion De Usuarios</h2>
                    <div class="inner_config">

                        <h3>Crear Usuario</h3>    
                        <form   id="createForm" method="post">
                            
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" required>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            <div>
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required>
                                @error('password')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <label for="role">Asignar Rol:</label>
                            <select id="role" name="role">
                                <option value="Usuario">Usuario</option>
                                <option value="Administrador">Administrador</option>
                            </select>
                            <button type="submit">Create User</button>
                        </form>

                        <h3>Usuarios Existentes</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Grupos</th>
                                    <th>Couta</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                            

                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->email}}</td>
                                    <td>{{$product->Role}}</td>
                                    <td>{{$product->grupos}}</td>
                                    <td>{{$product->couta_user}} Kb</td>
                                    
                                    <td>
                                        <button onclick="editUser({{$product->id}},'{{$product->name}}','{{$product->email}}','{{$product->Role}}','{property1,properti2}','{{$product->couta_user}}')" id="openPopupBtn" >Editar</button>
                                    
                                        @if ($product->id == 1)
                                        <button >Borrar (No S:Admin)</button>
                                        @else
                                            <button onclick="borrarUsuario({{$product->id}})" >Borrar </button>
                                        @endif
                                    
                                    
                                        
                                    </td>
                                </tr>

                                @endforeach
                                
                            </tbody>
                        </table>

                    </div>
                        

                <h2>Gestion De Grupos</h2>
                    <div class="inner_config">

                        <h3>Crear Un Nuevo Grupo</h3>
                        <form id="creargrupo"  method="post">
                            <label for="groupname">Nombre de Grupo:</label>
                            <input type="text" id="groupname" name="groupname" required>
                            <label for="groupdescription">Descripción:</label>
                            <textarea id="groupdescription" name="groupdescription"></textarea>
                            <button type="submit">Crear Grupo</button>
                        </form>

                        <h3>Grupos Existentes</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre De Grupo</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tdbody_group">
                                
                            </tbody>
                        </table>

                    </div>

            </div>
                



        </div>    
            


        <div class="littelmenu">
            @if (Route::has('login'))
                <div class="menu1">
                    @auth
                        <a href="{{ url('/test') }}" class="item">Home</a>
                        <a href="{{ route('logout') }}" class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        @else
                        <a href="{{ route('login') }}" class="item">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="item">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> 

          
       <script>


               async function getgrupos(){

                    

                        try {
                            const response = await fetch('/get_grupos', { 
                                method: 'GET',

                            });

                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);

                            }
                                const result = await response.json(); // Or response.text() depending on server response
                                return result ;
                                
                               // console.log('Get Grupos fue Exitoso:');
                                //console.log(result);
                               
                                
                                
                             
                        } catch (error) {
                            console.error('Error during Get Grupos :', error);
                            return null ;
                        }


                  


                    return "{'hola var'}";
                }


                async function DrawGrupoTable() {

                    //Get Grupos Tabla
                    const result1 = await getgrupos();
                    
                    //console.log("Result 1:", result1); // Will log the fetched data or null

                    //draw table grupos

                    const tdbody_group = document.getElementById('tdbody_group'); // Assuming a div with id="container" exists in your HTML
                    tdbody_group.innerHTML = ``;
                    // Iterate through the JSON data and create a div for each item
                    result1.forEach(item => {
                        // Create a new div element
                        const newDiv = document.createElement('tr');

                        // Add content to the div
                        newDiv.innerHTML = `
                        
                        <td>${item.nombre}</td>
                        <td>${item.descripcion}</td>
                
                <td>
                     
                    <button onclick="borrarGrupo(${item.id})">Borrar</button>
                </td>
                        
                         `;

                        // Add a class for styling (optional)
                        newDiv.classList.add('item-groupin');

                        // Append the new div to the tdbody_group
                        tdbody_group.append(newDiv);
                    });

                    
                }

                function doSomething() {
                    DrawGrupoTable();
                    // Your initialization code here
                    }
                    if (document.readyState === "loading") {
                    // Loading hasn't finished yet
                    document.addEventListener("DOMContentLoaded", doSomething);
                    } else {
                    // `DOMContentLoaded` has already fired
                    doSomething();
                }


                async function borrarGrupo(grupo_id){

                 

                    
                         
                        
                        
                        
                        const formData = new FormData();
                        formData.append('grupo_id', grupo_id);
                         
                         
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                       

                        

                        

                        
                            
                        try {
                            const response = await fetch('/borrar_grupo', { 
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                //console.log('se Borro el Grupo Exitosamente:');
                                //console.log(result);
                                const myForm = document.getElementById("creargrupo");
                                 
                                DrawGrupoTable();
                                
                            } else {
                                console.error('Se Borro el Grupo  failed:', response.statusText);
                                alert('Se Borro el Grupo  failed.');
                            }
                        } catch (error) {
                            console.error('Error during Se Borro el Grupo :', error);
                            alert('An error occurred during Se Borro el Grupo .');
                        }
                }


                async function borrarUsuario(usuario_id){

                 

                    
                         
                        
                        
                        
                        const formData = new FormData();
                        formData.append('usuario_id', usuario_id);
                         
                         
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                       

                        

                        

                        
                            
                        try {
                            const response = await fetch('/borrar_usuario', { 
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                //console.log('se Borro el usuario Exitosamente:');
                                //console.log(result);
                               
                                 window.location.reload(true);
                                
                                
                            } else {
                                console.error('Se Borro el usuario  failed:', response.statusText);
                                alert('Se Borro el usuario  failed.');
                            }
                        } catch (error) {
                            console.error('Error during Se Borro el usuario :', error);
                            alert('An error occurred during Se Borro el usuario .');
                        }
                }

                async function editUser(user_id,name,email,Role,grupos,couta_user){


                     
                    popupOverlay.style.display = 'flex'; // Show the popup

                    //set the select
                    const dropdown = document.getElementById('edit_role'); 
                    dropdown.value = Role; 


                    //set the couta_user
                    const couta_user_input = document.getElementById('cuota'); 
                    couta_user_input.value = couta_user; 


                    

                    //set user on popup
                    const inputElement = document.getElementById('edit_user_role_id');
                    inputElement.value = user_id;
 
                    //Get Grupos Tabla
                    const result1 = await getgrupos();
                    //console.log("Result 1:", result1); // Will log the fetched data or null

                    //draw table grupos

                    const container_div = document.getElementById('container_div'); // Assuming a div with id="container" exists in your HTML

                    // Iterate through the JSON data and create a div for each item
                    result1.forEach(item => {
                        // Create a new div element
                        const newDiv = document.createElement('div');

                        // Add content to the div
                        newDiv.innerHTML = `
                        <input type="radio" id="${item.nombre}" name="gruposcheck" value="${item.nombre}">
                        
                        <label for="${item.nombre}">${item.nombre}</label><br>`;

                        // Add a class for styling (optional)
                        newDiv.classList.add('item-group');

                        // Append the new div to the container_div
                        container_div.append(newDiv);
                    });
                }

                //Pop up con overlaying

                const openPopupBtn = document.getElementById('openPopupBtn');
                const popupOverlay = document.getElementById('popupOverlay');
                const closePopupBtn = document.getElementById('closePopupBtn');

                closePopupBtn.addEventListener('click', () => {
                    popupOverlay.style.display = 'none'; // Hide the popup
                     window.location.reload(true);
                });

                // Optionally, hide the popup when clicking outside the content
                popupOverlay.addEventListener('click', (event) => {
                    if (event.target === popupOverlay) {
                        popupOverlay.style.display = 'none';
                        window.location.reload(true);
                    }
                });



                    //Peticion Crear Grupo

                    document.getElementById('creargrupo').addEventListener('submit', async (event) => {
                        
                        event.preventDefault(); // Prevent default form submission
                         
                         
                        const groupname = document.getElementsByName("groupname");
                        const groupdescription = document.getElementsByName("groupdescription");
                         
                        
                        
                        const formData = new FormData();
                        formData.append('nombre', groupname[0].value);
                        formData.append('descripcion', groupdescription[0].value);
                         
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                       

                        

                        

                        
                            
                        try {
                            const response = await fetch('/crear_grupo', { 
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                //console.log('se Creo el Grupo Exitosamente:');
                                //console.log(result);
                                const myForm = document.getElementById("creargrupo");
                                myForm.reset();
                                DrawGrupoTable();
                                
                            } else {
                                console.error('Se Creo el Grupo  failed:', response.statusText);
                                alert('Se Creo el Grupo  failed.');
                            }
                        } catch (error) {
                            console.error('Error during Se Creo el Grupo :', error);
                            alert('An error occurred during Se Creo el Grupo .');
                        }


                    });

                        
            
                    //Peticion Editar ROl de Usuario

                    document.getElementById('editRole').addEventListener('submit', async (event) => {
                        
                        event.preventDefault(); // Prevent default form submission
                        
                        
                         
                        const edit_user_role_id = document.getElementsByName("edit_user_role_id");
                        const selectElement = document.querySelector('select[name="edit_role"]');
                        const selectedValue = selectElement.value;
                        
                        
                        const formData = new FormData();
                        formData.append('edit_user_role_id', edit_user_role_id[0].value);
                        formData.append('edit_role',  selectedValue);
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                       

                        

                        

                        
                            
                        try {
                            const response = await fetch('/edit_user_rol', { 
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                //console.log('Usuario editado Exitosamente:');
                                //console.log(result);
                                alert('Se edito el Usuario!');
                                
                            } else {
                                console.error('Usuario Editado failed:', response.statusText);
                                alert('Usuario Editado failed.');
                            }
                        } catch (error) {
                            console.error('Error during Usuario Editado:', error);
                            alert('An error occurred during Usuario Editado.');
                        }


                    });


                    //Peticion Editar Cuota de Usuario

                    document.getElementById('editCuota').addEventListener('submit', async (event) => {
                        
                        event.preventDefault(); // Prevent default form submission
                        
                        
                         
                        const edit_user_role_id = document.getElementsByName("edit_user_role_id");
                        const cuota_input = document.getElementsByName("cuota");
                         
                        
                        
                        const formData = new FormData();
                        formData.append('user_id', edit_user_role_id[0].value);
                        formData.append('couta_user', cuota_input[0].value);
                         
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                       

                        

                        

                        
                            
                        try {
                            const response = await fetch('/edit_user_cuota', { 
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                //console.log('Usuario editado Exitosamente:');
                                //console.log(result);
                                alert('Se edito el Usuario!');
                                
                            } else {
                                console.error('Usuario Editado failed:', response.statusText);
                                alert('Usuario Editado failed.');
                            }
                        } catch (error) {
                            console.error('Error during Usuario Editado:', error);
                            alert('An error occurred during Usuario Editado.');
                        }


                    });

                    // peticion Crear Usuario desde administrador
                    document.getElementById('createForm').addEventListener('submit', async (event) => {
                        
                        event.preventDefault(); // Prevent default form submission
                        
                        
                        const name = document.getElementsByName("name");
                         
                        const email = document.getElementsByName("email");
                        const password = document.getElementsByName("password");
                        const password_confirmation = document.getElementsByName("password_confirmation");
                        
                        const role = document.getElementsByName("role");

                        const formData = new FormData();
                        formData.append('name', name[0].value);
                        formData.append('email', email[0].value);
                        formData.append('password',  password[0].value);
                        formData.append('password_confirmation',  password_confirmation[0].value);

                        const selectElement = document.querySelector('select[name="role"]');
                        const selectedValue = selectElement.value;

                        formData.append('role',  selectedValue);
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                       

                        

                        

                        
                            
                        try {
                            const response = await fetch('/create_user', { 
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                //console.log('Usuario Creado Exitosamente:');
                                //console.log(result);
                                const myForm = document.getElementById("createForm");
                                myForm.reset();
                                window.location.reload(true);
                                
                            } else {
                                console.error('Usuario Creado failed:', response.statusText);
                                alert('Usuario Creado failed.');
                            }
                        } catch (error) {
                            console.error('Error during Usuario Creado:', error);
                            alert('An error occurred during Usuario Creado.');
                        }


                    });



                    //Peticion Editar Grupos de Usuario

                    document.getElementById('editGrupos').addEventListener('submit', async (event) => {
                        
                        event.preventDefault(); // Prevent default form submission
                        

                        const selectedRadio = document.querySelector('input[name="gruposcheck"]:checked');
                        if (selectedRadio) {
                             
                        } else {
                            alert("Primero,Seleccione el grupo");
                            return null; // No radio button is selected
                        }
                         
                         const selectedValues = selectedRadio.value;
                         //console.log(selectedValues);
                        const edit_user_role_id = document.getElementsByName("edit_user_role_id");
                                           
                        
                        const formData = new FormData();
                        formData.append('user_id', edit_user_role_id[0].value);
                        formData.append('grupos',  selectedValues);
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                       

                        

                        

                        
                            
                        try {
                            const response = await fetch('/edit_user_grupos', { 
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                //console.log('Usuario editado Exitosamente:');
                                //console.log(result);
                                alert('Se edito el Usuario!');
                                
                            } else {
                                console.error('Usuario Editado failed:', response.statusText);
                                alert('Usuario Editado failed.');
                            }
                        } catch (error) {
                            console.error('Error during Usuario Editado:', error);
                            alert('An error occurred during Usuario Editado.');
                        }


                    });


       </script>     

    </body>
</html>
