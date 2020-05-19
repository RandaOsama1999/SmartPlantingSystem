import serial
import numpy as np
import argparse
import cv2
import matplotlib.pyplot as plt
from datetime import datetime
import pytz
import mysql.connector
def convertRGBtoHSV(img):
    lower = np.array((36, 40, 40), dtype="uint8")
    upper = np.array((75, 255, 255), dtype="uint8")
    image = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
    Value = 0
    mask = cv2.inRange(image, lower, upper)
    output = cv2.bitwise_and(image, image, mask=mask)

    # print(Value)
    # print(cv2.countNonZero(mask)/img.size)
    ratio_green = cv2.countNonZero(mask) / (mask.size)
    print('green pixel percentage:', np.round(ratio_green * 100, 2))

    # cv2.imshow("1", mask)

    # cv2.imshow("images", np.hstack([img, output]))

    hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)

    # lower yellow
    lower_yellow = np.array([0, 150, 200], dtype="uint8")
    upper_yellow = np.array([100, 255, 255], dtype="uint8")

    # lower red
    lower_red = np.array([0, 150, 50])
    upper_red = np.array([16, 255, 255])

    mask_red = cv2.inRange(hsv, lower_red, upper_red)
    res_red = cv2.bitwise_and(img, img, mask=mask_red)

    mask_yellow = cv2.inRange(hsv, lower_yellow, upper_yellow)
    res_yellow = cv2.bitwise_and(img, img, mask=mask_yellow)

    final_mask = mask_red + mask_yellow
    final_result = cv2.bitwise_and(img, img, mask=final_mask)

    ratio_red = cv2.countNonZero(final_mask) / (final_mask.size)
    print('red pixel percentage:', np.round(ratio_red * 100, 2))

    # cv2.imshow("2", maskmerge)

    # cv2.imshow("images2", np.hstack([img, final_result]))

    # calling GreenTomatoFeatureExtractionKNN.py file

    # plt.imshow(mask, cmap='gray')  # this colormap will display in black / white
    # plt.show()
    return ratio_green,ratio_red