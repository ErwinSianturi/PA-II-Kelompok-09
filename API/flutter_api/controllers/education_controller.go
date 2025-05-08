package controllers

import (
	"flutter_api/models"
	"github.com/gin-gonic/gin"
	"gorm.io/gorm"
	"net/http"
)

type EducationController struct {
	DB *gorm.DB
}

func NewEducationController(db *gorm.DB) *EducationController {
	return &EducationController{DB: db}
}

func (controller *EducationController) AddEducation(c *gin.Context) {
	var education models.Education

	if err := c.ShouldBindJSON(&education); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	if err := controller.DB.Create(&education).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Gagal menyimpan data pendidikan"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"message": "Data pendidikan berhasil ditambahkan",
		"data":    education,
	})
}

func (controller *EducationController) GetAllEducations(c *gin.Context) {
	var educations []models.Education

	if err := controller.DB.Find(&educations).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Gagal mengambil data pendidikan"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"data": educations,
	})
}
