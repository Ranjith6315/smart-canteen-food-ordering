
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            padding: 20px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #176b45;
            color: white;
        }
        button {
            background: #176b45;
            color: white;
            border: 0;
            padding: 8px;
            cursor: pointer;
        }
        select { padding: 7px; }
        .message {
            background: #e1f5e8;
            padding: 12px;
        }
        .table-wrap { overflow-x: auto; }
    </style>
</head>
<body>
<div class="container">
    <h1>Order Management</h1>

    {% for message in get_flashed_messages() %}
        <p class="message">{{ message }}</p>
    {% endfor %}

    <div class="table-wrap">
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Total (Rs.)</th>
            <th>Status</th>
            <th>Update</th>
        </tr>

        {% for order in orders %}
        <tr>
            <td>{{ order.order_id }}</td>
            <td>{{ order.customer_name }}</td>
            <td>{{ order.phone or '-' }}</td>
            <td>{{ order.order_date }}</td>
            <td>{{ "%.2f"|format(order.total_amount) }}</td>
            <td>{{ order.status }}</td>
            <td>
                <form method="POST"
                      action="{{ url_for('update_order',
                                         order_id=order.order_id) }}">
                    <select name="status">
                        {% for s in
                        ['Pending', 'Preparing', 'Completed', 'Cancelled'] %}
                        <option value="{{ s }}"
                            {% if s == order.status %}selected{% endif %}>
                            {{ s }}
                        </option>
                        {% endfor %}
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        {% else %}
        <tr>
            <td colspan="7">No orders found.</td>
        </tr>
        {% endfor %}
    </table>
    </div>

    <p><a href="{{ url_for('home') }}">Back to Food Menu</a></p>
</div>
</body>
</html>
