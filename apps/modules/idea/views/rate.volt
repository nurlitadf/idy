{% extends 'layout.volt' %}

{% block title %}Rate Idea{% endblock %}

{% block styles %}

{% endblock %}

{% block content %}

{{ form('idea/rate', 'method': 'POST') }}
    <div class="form-group" style="margin-top:100px">
        <label for='name'>1 : </label>
        {{ radio_field('value', 'value': 1, 'class': "form-control") }}
        <label for='name'>2 : </label>
        {{ radio_field('value', 'value': 2, 'class': "form-control") }}
        <label for='name'>3 : </label>
        {{ radio_field('value', 'value': 3, 'class': "form-control") }}
        <label for='name'>4 : </label>
        {{ radio_field('value', 'value': 4, 'class': "form-control") }}
        <label for='name'>5 : </label>
        {{ radio_field('value', 'value': 5, 'class': "form-control") }}
        {{ hidden_field('ideaId', 'value': ideaId ) }}
    </div>

{{ submit_button('Submit') }}

{{ end_form() }}

{% endblock %}

{% block scripts %}

{% endblock %}