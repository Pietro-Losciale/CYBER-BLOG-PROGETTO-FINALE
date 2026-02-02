<x-layout>
<div class="container my-5">
    <h1>Modifica Profilo</h1>
    
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf 
        {{-- @method('PATCH') --}}
        @method('POST')
        
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nuova Password (opzionale)</label>
            <input type="password" name="password" class="form-control">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Conferma">
        </div>
        
        <button type="submit" class="btn btn-primary">Salva Profilo</button>
    </form>
</div>
</x-layout>
