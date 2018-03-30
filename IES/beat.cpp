

#include<bits/stdc++.h>
#include<stdio.h>
using namespace std;
int main()
{
    int t,n,b[100010],g[100010],i,j;
    scanf("%d",&t);
    while(t--)
    {
        int bt[100010]={0},gt[100010]={0};
        scanf("%d",&n);
        for(i=1;i<=n;i++)
        {
            scanf("%d",&b[i]);
        }
        for(i=1;i<=n;i++)
        {
            scanf("%d",&g[i]);
        }
        for(i=1;i<=n;i++)
        {
            if(g[b[i]]!=i)
            {
                bt[g[b[i]]]++;
            }
            if(b[g[i]]!=i)
            {
                gt[b[g[i]]]++;
            }
        }
        int max=-1;
        for(i=1;i<=n;i++)
        {
            if(bt[i]>max)
            {
                max=bt[i];
            }
            if(gt[i]>max)
            {
                max=gt[i];
            }
        }
        int count=0;
        for(i=1;i<=n;i++)
        {
            if(g[b[i]]!=i && g[b[g[b[i]]]]==i)
            {
                count++;
            }
            if(b[g[i]]!=i && b[g[b[g[i]]]]==i)
            {
                count++;
            }
        }
        printf("%d %d\n",max,count/2);
    }
    return(0);
}
