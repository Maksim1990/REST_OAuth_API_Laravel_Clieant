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
<h1>Home</h1>
<div class="col-sm-12 col-xs-12">
    <div class="col-sm-6  col-xs-12" id="links">
        <a href="/get-token" >Get authorization token</a><br>

        <a href="/register" >Register new user</a><br>

        <a href="/test" >Try API playground</a><br>
        <a href="/test" >Check API documentation based on Swagger</a><br>
    </div>
    </div>
{% endblock %}