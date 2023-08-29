# reference from https://kubernetes.io/zh-cn/docs/tasks/configure-pod-container/pull-image-private-registry/
# create a docker hub login secret

kubectl create secret docker-registry hublogin \
  --docker-server=https://index.docker.io/v1/ \
  --docker-username=chijian66666 \
  --docker-password=Jianchi010918 \