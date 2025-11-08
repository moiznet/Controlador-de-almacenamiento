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
<h1>Gestion De Archivos</h1>
    <div class="container_filemanager">

            <div class="file-manager-container">
                <h3>Gestor de Archivos</h3>

                <div class="upload-section">
                    <form id="uploadForm" >
                    @csrf
                    <input type="file" name="fileToUpload" id="myFile">
                    <button type="submit">Cargar</button>
                    </form>
                    
                    
                </div>

                <div class="file-list" id="fileList">
                    <!-- File and folder items will be dynamically loaded here -->
                    <div class="file-item">
                        <span class="file-name">Nombre de Archivo</span>
                        <span class="file-name">Tamaño</span>
                        <div class="file-actions">
                            <span class="file-name">Aciones</span>
                        </div>
                    </div>

                    @foreach($data as $row)
                            

                            <div class="file-item">
                                <span class="file-size"><a href=""></a>{{ $row->filename }}</span>
                                <span class="file-size">{{ $row->filesize }} Kb</span>
                                <div class="file-actions">
                                    <button onclick="download('/storage/uploads/{{ $row->filename }}')">Descargar</button>
                                    <button onclick="deleteItem({{ $row->id }})">Borrar</button>
                                </div>
                            </div>

                        @endforeach
                    


                    
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

        //download as a file

        function download(url) {
            const a = document.createElement('a')
            a.href = url
            a.download = url.split('/').pop()
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
        }


        //get user id
        window.Laravel = window.Laravel || {}; // Ensure window.Laravel exists
        window.Laravel.userId = {{ optional(auth()->user())->id }};
        
        console.log(window.Laravel.userId);

                     document.getElementById('uploadForm').addEventListener('submit', async (event) => {
                        
                        event.preventDefault(); // Prevent default form submission
                        const fileInput = document.getElementById('myFile');
                        const file = fileInput.files[0]; // Get the selected file

                        if (!file) {
                            alert('Please select a file to upload.');
                            return;
                        }

                        const formData = new FormData();
                        formData.append('file', file); // 'fileToUpload' should match the name attribute in the HTML input
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                        formData.append('userid', window.Laravel.userId);

                        

                        

                        
                            
                        try {
                            const response = await fetch('/upload', { // Replace with your server's upload endpoint
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                 
                                console.log(result);
                                window.location.reload(true);
                            } else {
                                console.error('File upload failed:', response.statusText);
                                alert('File upload failed.');
                            }
                        } catch (error) {
                            console.error('Error during file upload:', error);
                            alert('An error occurred during file upload.');
                        }


                    });




        function uploadFiles() {
            alert('Uload file ');


                    
            // This would involve sending files to a server endpoint
        }

        function downloadFile(filename) {
            alert('Downloading: ' + filename + '. This would link to a server endpoint.');
            // This would typically involve a link to a server-side script that serves the file
        }

        function renameItem(itemname) {
            let newName = prompt('Enter new name for ' + itemname + ':');
            if (newName) {
                alert('Renaming ' + itemname + ' to ' + newName + '. Server-side action required.');
            }
        }

        async function deleteItem(itemname) {

                        const formData = new FormData();
                        formData.append('archivo_id', itemname);
                         
                         
                        

                        const inputElements = document.getElementsByName("_token");
                        const csrfToken = inputElements[0].value;
                        
                        formData.append('_token', csrfToken);

                       

                        

                        

                        
                            
                        try {
                            const response = await fetch('/borrar_archivo', { 
                                method: 'POST',
                                body: formData,
                            });

                            if (response.ok) {
                                const result = await response.text(); // Or response.text() depending on server response
                                console.log('se Borro el archivo Exitosamente:');
                                console.log(result);
                               
                                 window.location.reload(true);
                                
                                
                            } else {
                                console.error('Se Borro el archivo  failed:', response.statusText);
                                alert('Se Borro el archivo  failed.');
                            }
                        } catch (error) {
                            console.error('Error during Se Borro el archivo :', error);
                            alert('An error occurred during Se Borro el archivo .');
                        }
             
        }

        
    </script> 


    </body>
</html>
