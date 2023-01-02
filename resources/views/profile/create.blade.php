<x-app-layout>

<div class="flex items-center min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto">
        <div class="max-w-md p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Please Fill Your Profile Pall!</h1>
            </div>
            <div class="m-7">
                <form action="{{ route('profile.store') }}" enctype='multipart/form-data' method='POST' id='form'>
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Full Name</label>
                        <input type="text" name="fullname" id="name" placeholder="John Doe" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <label for="dateofbirth" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Date of Birth</label>
                        <input type="date" name="dateofbirth" id="dateofbirth" placeholder="you@company.com" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <label for="gender" class="text-sm text-gray-600 dark:text-gray-400">Gender</label>
                        <select name="gender" id="gender" placeholder="" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <option selected>Choose Gender</option>
                        <option value="1">Man</option>
                        <option value="0">Woman</option>
                        </select>
                    </div>
                    <div class="py-3 mx-auto center">
                        <div class="w-48 px-4 py-5 text-center bg-white rounded-lg shadow-lg">
                          <div class="mb-4">
                            <img id="img" class="object-cover object-center w-auto mx-auto rounded-full" src="{{ asset('img/man.jpg')}}" alt="Avatar Upload" />
                          </div>
                          <label class="mt-6 cursor-pointer">
                            <span class="px-4 py-2 mt-2 text-sm text-base leading-normal text-white bg-blue-500 rounded-full" >Select Avatar</span>
                            <input name="avatar" id="avatar" type='file' class="hidden" :multiple="multiple" :accept="accept" />
                          </label>
                        </div>
                      </div>
                    <div class="mb-6">
                        <button type="submit" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Save</button>
                    </div>
                    <p class="text-base text-center text-gray-400" id="result">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(function(){
  $('#avatar').change(function(){
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
     {
        var reader = new FileReader();

        reader.onload = function (e) {
           $('#img').attr('src', e.target.result);
        }
       reader.readAsDataURL(input.files[0]);
    }
  });

});
  </script>
@endpush
</x-app-layout>
