<form role="search" action="search" aria-label="informations à chercher"
      class="z-0 absolute top-0 right-0 mt-6 mr-6" method="get">
    @csrf
    <label for="formSearch" class="hidden">Chercher dans l'application :</label>
    <input type="search" id="formSearch"
           class="searchInput rounded-xl border-2 border-orange-900 w-12 h-12 p-1 bg-transparent"
           name="search" required
           placeholder="Livres ou étudiants"
           aria-label="Search through site content">
    <input class="hidden" type="submit">
    <div class="submitDiv absolute top-0 right-0">
    </div>
</form>
