@extends('layouts.app')

@section('texto_informativo')
    <div class="row">
        <div class="col-12 text-center">
            <h2>Bienivenido al módulo de <label>Estimulos</label>.</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5><label>La información que se muestra en este módulo de estímulos {{ date("Y") - 1 }} es preliminar.</label></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h6>En caso de tener alguna inquietud en lo que respecta a la siguiente Información dirigirse a los responsables de los módulos:</h6>
            <ul>
                <li><label>Claudia Nava:</label> Difusión y divulgación</li>
                <li><label>Oscar García:</label> Formación de recursos humanos</li>
                <li><label>Isabel Mendoza:</label> Investigación Científica</li>
                <li><label>Beatriz Lizardi:</label> Transferencia de conocimiento</li>
            </ul>
            <h6>Acceso o duda pueden referirse a su servidor por medio de correo o a la ext 7821</h6>
        </div>
    </div>
@endsection
