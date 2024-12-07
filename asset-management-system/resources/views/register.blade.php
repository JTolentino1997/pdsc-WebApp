
<x-layout.main>
    <x-slot:header>
        <H1>header</H1>
     </x-slot:header>

    <div class="container">
        <form action="" method="POST">

             @csrf
             
             {{-- header --}}
            <x-form.quote/> 
     
            <x-form.input label="Name" name="name"/>
        
            <br>
            <x-form.input label="Email" type="email" name="email"/> 
        
            <br>
            <x-form.input label="Password" type="password" name="password"/> 
         
            <br>
            <x-form.input label="Confirm Password" type="password" name="password_confirmation"/> 
        
            <br> 
         
            <x-form.button label="Submit" :data="$data"/>
 
        </form>
     </div>

     <x-slot:footer>
        <H1>footer</H1>
     </x-slot:footer>
</x-layout.main>
 