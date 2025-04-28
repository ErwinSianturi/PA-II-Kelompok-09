package db

import (
	"fmt"
    "time"
	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var DB *gorm.DB

func InitDB() {
    dsn := "root:@tcp(127.0.0.1:3306)/laravel?parseTime=true&charset=utf8mb4&loc=Local"
	var err error
	DB, err = gorm.Open(mysql.Open(dsn), &gorm.Config{})
	if err != nil {
		fmt.Println("Failed to connect to database:", err)
		panic("Could not connect to the database!")
	}
	fmt.Println("Database connection successful")
}

type User struct {
    ID        uint      `json:"id" gorm:"primaryKey"`
    Name      string    `json:"name"`
    Email     string    `json:"email" gorm:"unique"`
    Password  string    `json:"password"`
    CreatedAt time.Time `json:"created_at"`
    UpdatedAt time.Time `json:"updated_at"`
}
func RegisterUser(name, email, password string) error {
    user := User{Name: name, Email: email, Password: password}
    result := DB.Create(&user)
    if result.Error != nil {
        return result.Error
    }
    return nil
}

func VerifyUser(email, password string) (bool, error) {
    var user User
    result := DB.Where("email = ?", email).First(&user)
    if result.Error != nil {
        return false, result.Error
    }
    if user.Password == password {
        return true, nil
    }
    return false, nil
}
