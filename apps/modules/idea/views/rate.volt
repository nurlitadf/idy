{% extends 'layout.volt' %}

{% block title %}Rate Idea{% endblock %}

{% block styles %}

{% endblock %}

{% block content %}

{{ form('idea/rate', 'method': 'POST') }}
    <div class="form-group" style="margin-top:100px">
        <label for='name'>Name: </label>
        {{ text_field('user', 'size': 100, 'class': "form-control") }}
        <label for='name'>Rating: </label>
        {{ text_field('value', 'size': 100, 'class': "form-control") }}
        {{ hidden_field('ideaId', 'value': ideaId ) }}
    </div>

{{ submit_button('Submit') }}

{{ end_form() }}

{% endblock %}

{% block scripts %}

{% endblock %}