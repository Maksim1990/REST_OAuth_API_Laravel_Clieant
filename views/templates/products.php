{% extends "app.php" %}
{% block title %}Index{% endblock %}
{% block head %}
{{ parent() }}
<style type="text/css">
    #links a { margin-bottom: 15px;
        display: inline-block;}
</style>
{% endblock %}
{% block content %}

<div class="col-sm-12 col-xs-12">
    <h1>REST API PRODUCTS playground page</h1>
    <div class="col-sm-6  col-xs-12" id="links">
        <a href="{{strSubfolderRoute}}/get-token" >Playground</a><br>
    </div>
</div>
{% endblock %}