import cv2
from fruit_classifier_svm import run_svm
from random import randint

def runsvm(img):
    #img=cv2.imread('dataset\\36.jpg')
    classes,predection = run_svm(img)
    if (predection[0] == 1):
        result = classes[0]
        print(result)
    elif (predection[0] == -1):
        result = "Not tomato"
        print(result)
    return result
#runsvm()