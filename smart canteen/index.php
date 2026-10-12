
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Canteen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            margin: 0;
            color: #222;
        }
        header {
            background: #176b45;
            color: white;
            text-align: center;
            padding: 22px;
        }
        main {
            max-width: 900px;
            margin: 25px auto;
            padding: 20px;
        }
        .card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ddd;
        }
        input, button {
            padding: 10px;
            margin: 6px 0;
            box-sizing: border-box;
        }
        input[type="text"], input[type="tel"] {
            width: 100%;
        }
        input[type="number"] {
            width: 85px;
        }
        button {
            background: #176b45;
            color: white;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
        }
        a { color: #176b45; }
        .message {
            background: #e1f5e8;
            padding: 12px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
<header>
    <h1>Smart Canteen</h1>
    <p>Food Ordering and Management System</p>
</header>

<main>
    <h2>Food Menu</h2>

    {% for message in get_flashed_messages() %}
        <div class="message">{{ message }}</div>
    {% endfor %}

    <form method="POST">
        <div class="card">
            <label>Customer Name</label>
            <input type="text" name="customer_name"
                   required maxlength="100">

            <label>Phone Number</label>
            <input type="tel" name="phone" maxlength="15">
        </div>

        {% for food in foods %}
        <div class="card">
            <h3>{{ food.food_name }}</h3>
            <p>Category: {{ food.category }}</p>
            <p>Price: Rs. {{ "%.2f"|format(food.price) }}</p>
            <label>Quantity:</label>
            <input type="number" name="qty_{{ food.food_id }}"
                   value="0" min="0" max="100">
        </div>
        {% endfor %}

        <button type="submit">Place Order</button>
    </form>

    <p><a href="{{ url_for('orders') }}">View All Orders</a></p>
</main>
</body>
</html>
