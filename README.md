# LeakHunter - Cybersecurity Data Breach Monitoring System

A comprehensive web-based application for monitoring data breaches and leaked information using the LeakOSINT API.

## Features

- 🔐 **Secure Authentication** - Bcrypt password hashing with session management
- 📊 **Interactive Dashboard** - Animated charts and real-time statistics
- 🔍 **Advanced Search** - Multiple search types with token management
- 📈 **Analytics** - Search history tracking and usage statistics
- 📝 **Activity Logs** - Comprehensive audit trail
- 👤 **Profile Management** - User settings and API token configuration
- 📱 **Responsive Design** - Mobile-friendly interface with Tailwind CSS
- 🎨 **Cyberpunk Theme** - Modern cybersecurity-inspired UI

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- cURL extension enabled
- PDO MySQL extension

## Installation

### 1. Database Setup

1. Create a MySQL database named `leakhunter`
2. Import the database schema:
   ```bash
   mysql -u root -p leakhunter < leakhunter.sql
   ```

### 2. Configuration

1. Update the database credentials in `config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'leakhunter');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   ```

2. Set your LeakOSINT API URL in `config.php`:
   ```php
   define('LEAKOSINT_API_URL', 'https://leakosintapi.com/');
   ```

### 3. File Permissions

Ensure the logs directory is writable:
```bash
chmod 755 logs/
chmod 644 logs/.htaccess
```

### 4. Web Server Configuration

Make sure your web server is configured to serve PHP files and has mod_rewrite enabled for Apache.

## Default Login Credentials

- **Email:** admin@fsociety.com
- **Password:** admin123

**⚠️ Important:** Change these credentials immediately after installation!

## API Integration

### Getting Your API Token

1. Contact the LeakOSINT bot on Telegram
2. Use the `/API` command to get your personal token
3. Update your API token in the profile settings

### API Pricing

The cost of requests depends on the search limit and complexity:
- Formula: `(5 + sqrt(Limit * Complexity)) / 5000`
- Default limit: 100 (costs approximately $0.003)
- Complexity depends on the number of words in your search query

## Security Features

- CSRF protection on all forms
- SQL injection prevention with prepared statements
- XSS protection with input sanitization
- Rate limiting for API requests
- Secure session management
- Password strength requirements
- Activity logging and monitoring

## File Structure

```
leakhunter/
├── config.php              # Configuration and database connection
├── index.php               # Main entry point
├── login.php               # Authentication page
├── logout.php              # Logout handler
├── dashboard.php           # Main dashboard
├── search.php              # Data search interface
├── history.php             # Search history
├── logs.php                # Activity logs
├── profile.php             # User profile management
├── sidebar.php             # Navigation sidebar
├── leakhunter.sql          # Database schema
├── .htaccess               # Security and URL rewriting
├── README.md               # This file
└── logs/                   # Application logs directory
```

## Usage

### 1. Login
Access the application and log in with your credentials.

### 2. Dashboard
View your account statistics, token balance, and recent activity.

### 3. Search Data
- Enter your search query (email, username, name, etc.)
- Select search type and limit
- Review estimated token cost
- Execute search and view results

### 4. Monitor Activity
- Check search history for past queries
- Review activity logs for security monitoring
- Update profile and API settings

## API Endpoints

The application integrates with the LeakOSINT API:
- **URL:** https://leakosintapi.com/
- **Method:** POST
- **Format:** JSON
- **Authentication:** API token

### Example API Request
```json
{
    "token": "your_api_token",
    "request": "example@gmail.com",
    "limit": 100,
    "lang": "en",
    "type": "json"
}
```

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials in `config.php`
   - Ensure MySQL service is running
   - Verify database exists and is accessible

2. **API Request Failures**
   - Verify API token is correct
   - Check internet connectivity
   - Ensure API endpoint is accessible

3. **Permission Errors**
   - Check file permissions on logs directory
   - Ensure web server has write access

4. **Session Issues**
   - Check PHP session configuration
   - Verify session directory is writable

### Log Files

Application logs are stored in the `logs/` directory:
- `app.log` - General application logs
- Check logs for detailed error information

## Security Considerations

1. **Change Default Credentials** - Update admin password immediately
2. **Use HTTPS** - Enable SSL/TLS in production
3. **Regular Updates** - Keep PHP and MySQL updated
4. **Backup Database** - Regular backups of user data
5. **Monitor Logs** - Review activity logs regularly
6. **API Token Security** - Keep API tokens secure and rotate regularly

## Support

For technical support or feature requests, please refer to the application logs and ensure all requirements are met.

## License

This application is for educational and authorized security testing purposes only. Users are responsible for complying with applicable laws and regulations.

---

**⚠️ Disclaimer:** This tool is designed for cybersecurity professionals and authorized testing only. Users must ensure they have proper authorization before conducting any security assessments or data searches.
