import sys
import numpy as np
import json
def run(a):
    # d = int(a)+int(b)
    # r = str(d)+c
    r = []
    r.append(str(a)+'0')
    r.append(str(a)+'1')
    r.append(str(a)+'2')
    r.append(str(a)+'3')
    return r
if __name__ == "__main__":
    # res = run(1)
    res = run(a=sys.argv[1])
    res = np.array(res)
    print(res)