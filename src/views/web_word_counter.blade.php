<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Web Word Counter</title>
        <meta name="description" content="The HTML5 Herald">
        <meta name="author" content="SitePoint">

        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
              crossorigin="anonymous"
        >
        <style>
            .center {
                margin-left: auto;
                margin-right: auto;
            }
        </style>

    </head>

    <body>
        <div class="container">
            @if(count($errors) > 0)
            <div class="row">
                <div class="col">
                    @foreach($errors as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <h1 style="text-align: center;">
                        Web Word Counter
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   id="urlInput"
                                   name="urlInput"
                                   aria-describedby="Url Input"
                                   placeholder="Enter the URL of the webpage you want counted"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary" name="btn_count_words">
                            Count Words
                        </button>
                    </form>
                </div>
            </div>
            @if(count($stats) > 0)
                <div class="row">
                    <div class="col">
                        <div class="alert alert-success" role="alert" style="text-align: center;">
                            <b>We found {{ $stats['total_words'] }} words</b>
                        </div>
                        <table class="center">
                            <tr>
                                <td><b>Keyword</b></td>
                                <td><b>Quantity</b></td>
                            </tr>
                            @foreach($stats as $word => $count)

                                @if($word === 'total_words')
                                    @continue
                                @endif

                                <tr>
                                    <td>
                                        {{ $word }}
                                    </td>
                                    <td>
                                        {{ $count }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            @endif
        </div>
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {

                $('button[name=btn_count_words]').click(function (event){
                    event.preventDefault();
                    let url = $('input[name=urlInput]').val();

                    window.location = "/webwordcounter?url="+ url;
                })
            });
        </script>
    </body>
</html>




