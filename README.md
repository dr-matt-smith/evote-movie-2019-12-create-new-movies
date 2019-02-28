# evote-movie-2019-12-create-new-movies

# evote-movie-2019-11-database-movie-data


Part of the progressive Movie Voting website project at:
https://github.com/dr-matt-smith/evote-movie-2019

The project has been refactored as follows:

- create a new template to display a form for a new Movie `/templates/newMovieForm.php`:

    ```php
      <?php
      require_once __DIR__ . '/_header.php';
      ?>
      
      <h1>Create new movie</h1>
      
      <form
              action = "index.php"
              methop = "GET"
      >
          <input type="hidden" name="action" value="createNewMovie">
      
          <p>
              Title:
              <input name="title">
      
          <p>
              Price:
              <input name="price">
      
          <p>
              <input type="submit">
      
      </form>
      
      <?php
      require_once __DIR__ . '/_footer.php';
      ?>
    ```
    
    - NOTE: this submits a hidden form field 'createNewMovie' to the Front Controller
    
- Add a link to display the form on the movie list page `/templates/list.php`:

    ```php
      <h2>Lists of movies and their average votes</h2>
      
      <table>
          <tr>
              <th> ID </th>
              <th> title </th>
              <th> price </th>
          </tr>
      
          <?php
              foreach($movies as $movie):
          ?>
                  <tr>
                      <td><?= $movie->getId() ?></td>
                      <td><?= $movie->getTitle() ?></td>
                      <td>&euro; <?= $movie->getPrice() ?></td>
                  </tr>
          <?php
              endforeach;
          ?>
      </table>
      
      <hr>
      <a href="index.php?action=newMovieForm">new movie form</a>
    ```

- Create a new controller class `AdminController` in directory `src`:

    ```php
      namespace Mattsmithdev;
      
      class AdminController
      {

      }
    ```
    
    - add method to display the new form:
    
        ```php
              function newMovieForm()
              {
                  $pageTitle = 'new movie';
                  require_once __DIR__ . '/../templates/newMovieForm.php';
              }
        ```
    
    - add method to process submission of the new movie form
    
        ```php
              function createNewMovie()
              {
                  $title = filter_input(INPUT_GET, 'title');
                  $price = filter_input(INPUT_GET, 'price');
          
                  $isValid = true;
                  $errors = [];
                  if(empty($title)) {
                      $isValid = false;
                      $errors[] = '- missing or empty title';
                  }
          
                  if(empty($price)){
                      $isValid = false;
                      $errors[] = '- missing or empty price';
                  } elseif(empty($price)){
                      $isValid = false;
                      $errors[] = '- price was not a number';
                  }
          
                  if($isValid){
                      $this->insertMovie($title, $price);
                  } else {
                      $pageTitle = 'error';
                      require_once __DIR__ . '/../templates/error.php';
                  }
              }
        ```
    
    - add method to take a valid title and price and insert a new row in the database, then display the movie list page:
    
        ```php
              private function insertMovie($title, $price)
              {
                  $movie = new Movie();
                  $movie->setTitle($title);
                  $movie->setPrice($price);
          
                  $movieRepository = new MovieRepository();
                  $success = $movieRepository->create($movie);
          
                  if($success){
                      // now list all movies
                      $mainController = new MainController();
                      $mainController->listMovies();
                  } else {
                      $errors = [];
                      $errors[] = "there was an error trying to create movie with title = '$title' and price = '$price'";
                      $pageTitle = 'error';
                      require_once __DIR__ . '/../templates/error.php';
                  }
              }
          }
        ```
    
    

- In the Front Controller `/public/index.php` do the following:

    - add code to create a variable `$adminController`
    
    - add 2 new routes in the `switch` statement to display the form and to process form submission ``:

    ```php          
        // ------ admin section --------
        case 'newMovieForm':
            $adminController->newMovieForm();
            break;
    
        case 'createNewMovie':
            $adminController->createNewMovie();
            break;
    ```
    
- change the contents of `/src/MovieRepository` to become a subclass of `DatabaseTableRepository`, and so provide all the database CRUD operations automatically through inspection of the properties of the `Movie` class:

    ```php
      namespace Mattsmithdev;
      
      use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;
      
      class MovieRepository extends DatabaseTableRepository
      {
          public function __construct()
          {
              parent::__construct('Mattsmithdev', 'Movie', 'movie');
          }
      }
    ```