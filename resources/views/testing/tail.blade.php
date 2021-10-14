<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{url('assets/tailwind/')}}/css/styles.css">
        <title>Select2 Tailwind CSS Demo</title>
        <style>
            .elem{
    position: absolute;
    top: 40px;
    left: 40px;
    width: 0; 
    height: 0;
    border-style: solid;
    border-width: 75px;
    border-color: red blue green orange;
    transition-property: transform;
    transition-duration: 1s;
}
.elem:hover {
    animation-name: rotate; 
    animation-duration: 2s; 
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@keyframes rotate {
    from {transform: rotate(0deg);}
    to {transform: rotate(20deg);}
}
        </style>
    </head>
    <body>

        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.selectpicker').select2();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });
        </script>

        <div class="flex justify-center p-4 px-3 py-10">
            <div class="w-full max-w-lg">
                <div class="shadow-drop-center bg-white rounded shadow">
                    <div class="border-b py-4 text-gray-700 text-center text-xl tracking-wider">
                        Tailwind CSS and Select2 single example

                        {{-- <span class="flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-50"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
                          </span> --}}
                          <div class="p-20">
                            <div class="animate-roll bg-blue-600 border-2 border-blue-700 text-white px-8 py-2 rounded-md text-center w-40 font-bold text-xl">
                              Hello Tailwind!
                            </div>
                          </div>
                    </div>
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                        method="POST"
                        autocomplete="on"
                        novalidate
                    >

                        <div class="mb-4">
                            <label class="block text-gray-700 text-md font-bold mb-2" for="pair">
                                Choose your city:
                            </label>
                            <select
                                class="selectpicker" style="width: 100%" 
                                data-placeholder="Select a city..."
                                data-allow-clear="false"
                                title="Select city...">
                                <option>Amsterdam</option>
                                <option>Rotterdam</option>
                                <option>Den Haag</option>
                                <option>Den Haag - Paijo - Malang </option>
                                <option>123 - Pagak</option>
                                <option>QWE - Pagak</option>
                                
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <a class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="#"> Submit
                            </a>
                            
                            <a class="bg-transparent hover:bg-blue-600 active:bg-blue-700 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded focus:outline-none focus:shadow-outline" href="#"> Cancel
                            </a>
                        </div>
                    </form>
                </div>

                <div class="shadow-drop-center bg-white rounded shadow mt-8">
                    <div class="border-b py-4 text-gray-700 text-center text-xl tracking-wider">
                        Tailwind CSS and Select2 multiple example <div class="elem"></div>
                    </div>
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                        method="POST"
                        autocomplete="on"
                        novalidate
                    >

                        <div class="mb-4">
                            <label class="block text-gray-700 text-md font-bold mb-2" for="pair">
                                Choose your cities:
                            </label>
                            <select
                                class="js-example-basic-multiple" style="width: 100%" 
                                data-placeholder="Select one or more cities..."
                                data-allow-clear="false"
                                multiple="multiple"
                                title="Select city...">
                                <option>Amsterdam</option>
                                <option>Rotterdam</option>
                                <option>Den Haag</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <a class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline animate-spin " href="#"> Submit
                            </a>
                            
                            <a class="bg-transparent hover:bg-blue-600 active:bg-blue-700 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded focus:outline-none focus:shadow-outline" href="#"> Cancel
                            </a>
                        </div>
                    </form>
                </div>

                <div class="min-h-screen flex flex-wrap justify-around items-center">

                    <button
                     class="transform hover:rotate-180 transition duration-500 ease-in-out bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg">
                     Rotate Me 180°
                    </button>
                   
                    <button
                     class="transform hover:scale-150 transition duration-500 ease-in-out bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                     Scale Me 1.5×
                    </button>
                   
                    <button
                     class="transform hover:translate-x-20 hover:translate-y-20 transition duration-500 ease-in-out bg-red-400 text-white font-bold py-2 px-4 rounded-lg">
                     Translate Me 5rem
                    </button>
                   
                    <button
                     class="transform hover:skew-x-12 hover:skew-y-12 transition duration-500 ease-in-out bg-red-400 text-white font-bold py-2 px-4 rounded-lg">
                     Skew Me 12°
                    </button>
                   
                   </div>

            </div>  
        </div>
    </body>
</html>
